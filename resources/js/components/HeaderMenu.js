export const HeaderMenu = {
		data() {
				return {
						visible: false,
						opacity: '',
						zIndex: '',
						toggleDelay: 300
				};
		},

		methods: {
				toggleMenu() {
						this.visible = !this.visible;

						if(this.visible) {

								this.zIndex = 50;
								setTimeout(() => {
										this.opacity = 1;
								}, this.toggleDelay);

						} else {

								this.opacity = '';
								setTimeout(() => {
										this.zIndex = '';
								}, this.toggleDelay);

						}
				}
		},

		created() {
				this.$root.$on('menu-toggled', this.toggleMenu);
		}
};
