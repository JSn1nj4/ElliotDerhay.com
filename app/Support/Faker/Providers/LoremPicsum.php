<?php

namespace App\Support\Faker\Providers;

use App\DataTransferObjects\QueryParam;
use App\DataTransferObjects\Result;
use Faker\Provider\Base;
use Illuminate\Support\Number;

class LoremPicsum extends Base
{
	public const BASE_URL = 'https://picsum.photos';
	public const FORMAT_JPG = 'jpg';
	public const FORMAT_JPEG = 'jpeg';
	public const FORMAT_WEBP = 'webp';

	protected static function fetchImage(string $url, string $filepath, string|null $filename = null, bool $returnFullPath = false): Result
	{
		$filename ??= str($filepath)->afterLast(DIRECTORY_SEPARATOR);

		// save file route 1: curl_exec
		if (function_exists('curl_exec')) {
			// use cURL
			$fp = fopen($filepath, 'w');
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);

			$success = curl_exec($ch) && curl_getinfo($ch, CURLINFO_HTTP_CODE) === 200;
			$result = curl_getinfo($ch); // keep for connection debugging for now

			fclose($fp);
			curl_close($ch);

			// need to follow redirect

			if (!$success) {
				unlink($filepath);

				// could not contact the distant URL or HTTP error - fail silently.
				return new Result(false, ['curlinfo' => $result]);
			}

			return new Result(true, ['path' => match (true) {
				$returnFullPath => $filepath,
				default => $filename,
			}]);
		}

		// save file route 1: allow_url_fopen
		if (ini_get('allow_url_fopen')) {
			// use remote fopen() via copy()
			$success = copy($url, $filepath);

			return new Result($success, match (true) {
				!$success => [], // could not contact the distant URL or HTTP error - fail silently.
				$returnFullPath => ['path' => $filepath],
				default => ['path' => $filename],
			});
		}

		// unable to contact remote server
		return new Result(false, errors: [new \RuntimeException('The image formatter downloads an image from a remote HTTP server. Therefore, it requires that PHP can request remote hosts, either via cURL or fopen()')]);
	}

	public static function image(
		string|null $dir = null,
		int         $width = 640,
		int         $height = 480,
		bool        $fullPath = true,
		bool        $gray = false,
		string      $format = 'jpg',
		bool|null   $blur = null,
	): false|string|\Exception
	{
		$dir ??= sys_get_temp_dir();

		// Validate directory path
		if (!is_dir($dir) || !is_writable($dir)) {
			throw new \InvalidArgumentException(sprintf('Cannot write to directory "%s"', $dir));
		}

		// Generate a random filename. Use the server address so that a file
		// generated at the same time on a different server won't have a collision.
		$name = md5(uniqid(empty($_SERVER['SERVER_ADDR']) ? '' : $_SERVER['SERVER_ADDR'], true));
		$filename = strtr(':name.:format', [
			':name' => $name,
			':format' => $format,
		]);
		$filepath = $dir . DIRECTORY_SEPARATOR . $filename;

		$url = static::imageUrl($width, $height, $gray, $format, $blur);

		$result = static::fetchImage($url, $filepath, $filename, $fullPath);

		if ($result->failed()) {
			$result = static::maybeRetry($result, static fn ($retryUrl) => static::fetchImage($retryUrl, $filepath, $filename, $fullPath));
		}

		return static::handleReturn($result);
	}

	public static function imageUrl(
		int      $width = 640,
		int      $height = 480,
		bool     $gray = false,
		string   $format = 'png',
		int|null $blur = null,
	)
	{
		// Validate image format
		$imageFormats = static::getFormats();

		if (!in_array(strtolower($format), $imageFormats, true)) {
			throw new \InvalidArgumentException(sprintf(
				'Invalid image format "%s". Allowable formats are: %s',
				$format,
				implode(', ', $imageFormats),
			));
		}

		$params = [];

		if ($gray === true) {
			$params[] = new QueryParam('grayscale', allow_empty: true);
		}

		if ($blur !== null) {
			$blur = Number::clamp($blur, 1, 10);

			$params[] = match (true) {
				$blur > 1 => new QueryParam('blur', $blur),
				default => new QueryParam('blur', allow_empty: true),
			};
		}

		return strtr(":url/:w/:h.:format:params", [
			':url' => self::BASE_URL,
			':w' => $width,
			':h' => $height,
			':format' => match ($format) {
				'jpeg' => 'jpg',
				default => $format,
			},
			':params' => count($params) > 0 ? '?' . build_query_string($params) : ''
		]);
	}

	public static function getFormats(): array
	{
		return array_keys(static::getFormatConstants());
	}

	public static function getFormatConstants(): array
	{
		return [
			static::FORMAT_JPG => constant('IMAGETYPE_JPEG'),
			static::FORMAT_JPEG => constant('IMAGETYPE_JPEG'),
			static::FORMAT_WEBP => constant('IMAGETYPE_WEBP'),
		];
	}

	/**
	 * @param \App\DataTransferObjects\Result $result
	 * @return false|string|\Exception
	 */
	protected static function handleReturn(Result $result): false|string|\Exception
	{
		// always return the first error
		if ($result->hasErrors()) return $result->errors[0];

		if ($result->failed()) return false;

		if (isset($result->data['path'])) return $result->data['path'];

		throw new \RuntimeException('Unable to resolve return value.');
	}

	protected static function maybeRetry(Result $old_result, callable|\Closure $retry): Result
	{
		$curlinfo = $old_result->data['curlinfo'];

		if ($curlinfo === null) return $old_result;

		if ($curlinfo['http_code'] !== 302) return $old_result;

		$redirect_url = $curlinfo['redirect_url'];

		if ($redirect_url === null) return $old_result;

		$matched = preg_match('/^https:\/\/(fastly\.)?picsum\.photos\/.*$/', $redirect_url);

		return !!$matched ? $retry($redirect_url) : $old_result;
	}
}
