<div class='sidebar-track relative h-full'>
	<div class='relative h-full flex{{ $mirror ? ' -scale-x-100' : '' }}'>
		<div class='relative w-5'>
			<div
				class='w-full h-full bg-gradient-to-r from-slate-800 via-slate-700 via-80% to-slate-600 border-r-2 border-solid border-r-slate-800'></div>
		</div>
		<div class='relative w-0.5'>
			<div
				class='w-full h-full bg-gradient-to-r from-transparent from-50% via-slate-600  via-50% to-slate-500'></div>
		</div>
		<div class='teeth relative w-0.5 h-full'></div>
	</div>
	<div
		class='fixed{{ $mirror ? ' -scale-x-100' : '' }} top-0 w-6 h-screen opacity-0 scroll:opacity-100 transition-opacity duration-700'>
		<div
			class='-ml-px2 w-full h-full bg-radial-[at_100%_100%] from-bright-turquoise-200/50 via-bright-turquoise-500/40 via-30% to-transparent to-50%'></div>
	</div>
</div>
