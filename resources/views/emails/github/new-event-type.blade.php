<!DOCTYPE html>
<html lang="en-us" dir="ltr">
		<head>
				<meta charset="utf-8">
		</head>
		<body>

				<h3>New GitHub event types are listed below.</h3>

				<p>Click an item to view its description and payload info.</p>

				<ol>
						@foreach ($types as $value)
						<li>
								<a href="https://docs.github.com/en/developers/webhooks-and-events/github-event-types#{{strtolower($value)}}" target="_blank">{{ $value }}</a>
						</li>
						@endforeach
				</ol>

		</body>
</html>
