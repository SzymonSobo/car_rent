const header = document.querySelector('#header');
const burgerIcon = document.querySelector('.navbar-toggler');
const nav = document.querySelector('.navbar');
const navBar = document.querySelector('.navbar-nav');
const navMenu = document.querySelector('#navbarNavAltMarkup');
const navLink = document.querySelectorAll('.nav-link');
const topButton = document.querySelector('.fa-arrow-up');
const avalibleLink = document.querySelector('.avalible');
const avalibleSection = document.querySelector('#avalible');
const unvalibleLink = document.querySelector('.unvalible');
const unvalibleSection = document.querySelector('#unvalible');
const reservationLink = document.querySelector('.reservation');
const reservationSection = document.querySelector('#reservation');
const select = document.querySelector('.car')
const minDate= document.querySelector('#date')
const finalPrice = document.querySelector('.finalPrice');
const days = document.querySelector('#days')
const hours = document.querySelector('#hours')


  var swiper = new Swiper('.swiper', {
	// Install Plugin To Swiper
	slidesPerView: 4,
      spaceBetween: 20,
	  
	navigation: {
	  nextEl: '.swiper-button-next',
	  prevEl: '.swiper-button-prev',
	},
	// Enable debugger
	debugger: true,
  });

const footerDate = () => {
	document.querySelector('.curentYear').innerHTML = new Date().getFullYear();		
};
const scrollTop = () => {
	window.scrollTo(0, 0);
};
const smoothScroll = (value) => {
	const section = document.querySelector(value);
	if (innerWidth > 992) {
		window.scrollTo(0, section.offsetTop - 30);
	} 
	else {
		if (value === '#Home') {
			window.scrollTo(0, section.offsetTop);
		} 
		else {
			window.scrollTo(0, section.offsetTop + 70);
		}
		navMenu.classList.remove('showMenu');
		navMenu.classList.add('closeMenu');
		setTimeout(() => 
		{
			navBar.classList.toggle('display');
		}, 1000);
	}
}
const activeSection = () => {
	if (window.innerWidth > 992) {
		if (window.scrollY < avalibleSection.offsetTop - 60) {
			avalibleLink.classList.remove('active-menu');
			unvalibleLink.classList.remove('active-menu');
			reservationLink.classList.remove('active-menu');
		} 
		else if (
			window.scrollY > avalibleSection.offsetTop - 60 &&
			window.scrollY < unvalibleSection.offsetTop - 60
		) {
			avalibleLink.classList.add('active-menu');
			unvalibleLink.classList.remove('active-menu');
			reservationLink.classList.remove('active-menu');
		} 
		else if (
			window.scrollY > unvalibleSection.offsetTop - 60 &&
			window.scrollY < reservationSection.offsetTop-370
		) {
			avalibleLink.classList.remove('active-menu');
			unvalibleLink.classList.add('active-menu');
			reservationLink.classList.remove('active-menu');
		} 
		else if (window.scrollY >= reservationSection.offsetTop - 370) {
			avalibleLink.classList.remove('active-menu');
			unvalibleLink.classList.remove('active-menu');
			reservationLink.classList.add('active-menu');
		}
	}
}
const show = () => {
		nav.style.background = 'transparent';

		if (window.innerWidth > 992) {
					navLink.forEach((Link) => {
					Link.style.color = 'rgba(255, 255, 255, 0.55)';
					topButton.style.opacity = '0'
				});
				if (window.scrollY > 100) {
					showButton();
				}
				if (window.scrollY > 150) {
					nav.style.background = 'rgba(255, 255, 255, 1)';
					navLink.forEach((Link) => {
						Link.style.color = 'black';
					});
				}
				if (window.scrollY > unvalibleSection.offsetTop-unvalibleSection.offsetHeight/2) {
					topButton.style.color = 'white';
				}
				if (window.scrollY > reservationSection.offsetTop-350) {
					topButton.style.color = 'black';
				}
		};
}
const showButton = () => {
	topButton.style.opacity = '1';
	topButton.style.color = 'black';
};

window.onscroll = function () {
	show();
	activeSection();
};
const toggleMenu = () => {
	if (navMenu.classList.contains('showMenu')) {
		navMenu.classList.remove('showMenu');
		navMenu.classList.add('closeMenu');
		setTimeout(() => {
			navBar.classList.toggle('display');
		}, 1000);
	} else {
		navBar.classList.toggle('display');
		navMenu.classList.remove('closeMenu');
		navMenu.classList.add('showMenu');
	}
};

const reserve = (car) => {
	const option= select.querySelector('option[value="'+car+'"]');
	const optionSelected = select.querySelectorAll('option[selected]')
	optionSelected.forEach(element => {
		element.removeAttribute("selected");
	});
	option.setAttribute("selected","")
	smoothScroll('#reservation');
}

const calculatePrice = (price) => {
	lookPrice(price);
	days.addEventListener('change',function () {
		lookPrice(price);
	});
	hours.addEventListener('change',function () {
		lookPrice(price);
	})
}
const lookPrice = (price) => {
	finalPrice.innerHTML ='';
	const numberOfDays = days.value;
	const numberOfHours = hours.value;
	const finalCost = (numberOfDays*24*price)+(numberOfHours*price);
	finalPrice.innerHTML = finalCost ;

}
const currentDate = () => {
	const day= new Date().getDay();
	const month= new Date().getMonth();
	const year= new Date().getFullYear();
	minDate.min=`${year}-${month}-${day}`;
}
  
window.addEventListener('load',footerDate)
topButton.addEventListener('click', scrollTop);
burgerIcon.addEventListener('click', toggleMenu);