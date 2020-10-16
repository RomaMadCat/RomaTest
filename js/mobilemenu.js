var mobileMenuButton = document.querySelector('.navbar-toggle');
	mobileMenu = document.getElementById('menu-toggle');
	page = document.getElementById('page');

mobileMenuButton.addEventListener('click', function() {
	if (mobileMenu.classList.contains('menuMobileDisplay')) {
		mobileMenu.classList.remove('menuMobileDisplay');
	}
	else {
		mobileMenu.classList.add('menuMobileDisplay');
	}
});

page.addEventListener('touchstart', function() {
	if (mobileMenu.classList.contains('menuMobileDisplay')) {
		return true;
	}
	else {
		mobileMenu.classList.add('menuMobileDisplay');
	}
});

page.addEventListener('click', function() {
	if (mobileMenu.classList.contains('menuMobileDisplay')) {
		return true;
	}
	else {
		mobileMenu.classList.add('menuMobileDisplay');
	}
});


