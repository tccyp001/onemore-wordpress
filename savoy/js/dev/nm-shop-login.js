(function($) {
	
	'use strict';
	
	$(document).ready(function() {
		
		var animTimeout = 250;
		
		
		/* Show register form */
		function showRegisterForm() {
			// Header links
			$('#nm-show-register-link').addClass('hide');
			$('#nm-show-login-link').removeClass('hide');
			
			// Form wrapper elements
			var $loginWrap = $('#nm-login-wrap'),
				$registerWrap = $('#nm-register-wrap');
			
			// Login/register form
			$loginWrap.removeClass('fade-in');
			setTimeout(function() {
				$registerWrap.addClass('inline fade-in slide-up');
				$loginWrap.removeClass('inline slide-up');
			}, animTimeout);
		};
		
		/* Show login form */
		function showLoginForm() {
			// Header links
			$('#nm-show-login-link').addClass('hide');
			$('#nm-show-register-link').removeClass('hide');
			
			// Form wrapper elements
			var $loginWrap = $('#nm-login-wrap'),
				$registerWrap = $('#nm-register-wrap');
			
			// Login/register form
			$registerWrap.removeClass('fade-in');
			setTimeout(function() {
				$loginWrap.addClass('inline fade-in slide-up');
				$registerWrap.removeClass('inline slide-up');
			}, animTimeout);
		};
		
		
		/* Bind: Show register form header link */
		$('#nm-show-register-link').bind('click', function(e) {
			e.preventDefault();
			showRegisterForm();
		});
		
		
		/* Bind: Show login form header link */
		$('#nm-show-login-link').bind('click', function(e) {
			e.preventDefault();
			showLoginForm();
		});
		
		
		/* Bind: Show register form button */
		$('#nm-show-register-button').bind('click', function(e) {
			e.preventDefault();
			showRegisterForm();
		});
		
		
		/* Bind: Show login form button */
		$('#nm-show-login-button').bind('click', function(e) {
			e.preventDefault();
			showLoginForm();
		});
		
	});
})(jQuery);
