<div class='sidebar-track relative h-full'>
	<div class='relative h-full flex{{ $mirror ? ' -scale-x-100' : '' }}'>
		<div class='relative w-5'>
			<div
				class='w-full h-full bg-gradient-to-r from-slate-800 via-slate-700 via-80% to-slate-600 border-r-2 border-solid border-r-slate-800'></div>
		</div>
		<div class='relative w-0.5'>
			<div
				class='w-full h-full bg-gradient-to-r from-black from-50% via-slate-600  via-50% to-slate-500'></div>
		</div>
		<div class='teeth relative w-0.5 h-full'></div>
	</div>
	<div
		class='fixed {{ $mirror ? '-scale-x-100 right-5' : 'left-5' }} top-0 w-3 h-screen opacity-0 scroll:opacity-100 transition-opacity duration-700'>
		<div
			class='-ml-px2 w-3/5 h-full bg-gradient-to-t from-bright-turquoise-100 via-bright-turquoise-500/70 via-10% to-transparent to-50%'></div>
	</div>
</div>
