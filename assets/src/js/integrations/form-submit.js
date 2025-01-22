/**
 * Plausible Analytics
 *
 * Track Form Submissions JS
 */
document.addEventListener('DOMContentLoaded', () => {
	let plausible_track_form_submit = {
		forms: document.querySelectorAll('form'),

		/**
		 * Initialization.
		 */
		init: function () {
			this.bindEvents();
		},

		/**
		 * Bind Events.
		 */
		bindEvents: function () {
			let self = this;

			this.forms.forEach((form) => {
				form.addEventListener('submit', (e) => {
					if (self.isValid(e.target)) {
						self.trackSubmission();
					}
				})
			})
		},

		/**
		 * Runs basic validation on the form.
		 *
		 * @param form
		 * @returns {boolean}
		 */
		isValid: function (form) {
			let self = this;
			let valid = true;

			Array.from(form).some((element) => {
				if (self.isInput(element)) {
					if ((element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') && element.required === true && element.value === '') {
						valid = false;

						return;
					}

					/**
					 * A known caveat in this check is, that if the first option in the SELECT is e.g. "Please make a choice", it will still pass as valid.
					 */
					if (element.tagName === 'SELECT' && element.required === true && element.selectedIndex < 0) {
						valid = false;

						return;
					}
				}
			});

			return valid;
		},

		/**
		 * Is element an input field?
		 *
		 * @param element
		 * @returns {boolean}
		 */
		isInput: function (element) {
			let inputs = ['INPUT', 'SELECT', 'TEXTAREA'];

			return inputs.includes(element.tagName);
		},

		/**
		 * Send a custom event to Plausible.
		 */
		trackSubmission: function () {
			console.log('trackSubmission');
		}
	};

	plausible_track_form_submit.init();
});
