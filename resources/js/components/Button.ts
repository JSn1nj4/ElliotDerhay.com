export const ToggleButton = {
		props: ['clickHandler'],
		methods: {
				toggle() {
						this.clickHandler();
				}
		}
};
