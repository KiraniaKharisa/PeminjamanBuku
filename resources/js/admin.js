// SIDEBAR DROPDOWN
const allDropdown = document.querySelectorAll('#sidebar .side-dropdown');
const sidebar = document.getElementById('sidebar');

allDropdown.forEach(item=> {
	const a = item.parentElement.querySelector('a:first-child');
	a.addEventListener('click', function (e) {
		e.preventDefault();

		if(!this.classList.contains('active')) {
			allDropdown.forEach(i=> {
				const aLink = i.parentElement.querySelector('a:first-child');

				aLink.classList.remove('active');
				i.classList.remove('show');
			})
		}

		this.classList.toggle('active');
		item.classList.toggle('show');
	})
})

// SIDEBAR COLLAPSE
const toggleSidebar = document.querySelector('nav .toggle-sidebar');
const toggleSidebar2 = document.getElementById('toggle-sidebar-2');
const iconToggle = toggleSidebar.querySelector('i');
const textToggle2 = toggleSidebar2.querySelector('a span');
const iconToggle2 = toggleSidebar2.querySelector('a i');
const allSideDivider = document.querySelectorAll('#sidebar .divider');

if(sidebar.classList.contains('hide')) {
	iconToggle.classList.replace('bx-chevrons-left', 'bx-chevrons-right');
	iconToggle2.classList.replace('bx-collapse', 'bx-expand');
	textToggle2.textContent = 'Perbesar';

	allSideDivider.forEach(item=> {
		item.textContent = '-'
	})
	allDropdown.forEach(item=> {
		const a = item.parentElement.querySelector('a:first-child');
		a.classList.remove('active');
		item.classList.remove('show');
	})
} else {
	iconToggle.classList.replace('bx-chevrons-right', 'bx-chevrons-left');
	iconToggle2.classList.replace('bx-expand', 'bx-collapse');
	textToggle2.textContent = 'Perkecil';

	allSideDivider.forEach(item=> {
		item.textContent = item.dataset.text;
	})
}

function toggleSidebarFunction() {
	sidebar.classList.toggle('hide');

	if(sidebar.classList.contains('hide')) {
		iconToggle.classList.replace('bx-chevrons-left', 'bx-chevrons-right');
		iconToggle2.classList.replace('bx-collapse', 'bx-expand');
		textToggle2.textContent = 'Perbesar';

		allSideDivider.forEach(item=> {
			item.textContent = '-'
		})

		allDropdown.forEach(item=> {
			const a = item.parentElement.querySelector('a:first-child');
			a.classList.remove('active');
			item.classList.remove('show');
		})
	} else {
		iconToggle.classList.replace('bx-chevrons-right', 'bx-chevrons-left');
		iconToggle2.classList.replace('bx-expand', 'bx-collapse');
		textToggle2.textContent = 'Perkecil';

		allSideDivider.forEach(item=> {
			item.textContent = item.dataset.text;
		})
	}
}

toggleSidebar.addEventListener('click', toggleSidebarFunction);
toggleSidebar2.addEventListener('click', toggleSidebarFunction);




sidebar.addEventListener('mouseleave', function () {
	if(this.classList.contains('hide')) {
		allDropdown.forEach(item=> {
			const a = item.parentElement.querySelector('a:first-child');
			a.classList.remove('active');
			item.classList.remove('show');
		})
		allSideDivider.forEach(item=> {
			item.textContent = '-'
		})
	}
})



sidebar.addEventListener('mouseenter', function () {
	if(this.classList.contains('hide')) {
		allDropdown.forEach(item=> {
			const a = item.parentElement.querySelector('a:first-child');
			a.classList.remove('active');
			item.classList.remove('show');
		})
		// allSideDivider.forEach(item=> {
		// 	item.textContent = item.dataset.text;
		// })
	}
})




// PROFILE DROPDOWN
const profile = document.querySelector('nav .profile');
const dropdownProfile = profile.querySelector('.profile-link');
const icon_toggle_input = document.querySelector('#icon-toggle-input');
const form_group_melayang = document.querySelector('.form-group-melayang');

profile.addEventListener('click', function () {
	dropdownProfile.classList.toggle('show');
	form_group_melayang.classList.remove('show');
})

icon_toggle_input.addEventListener('click', () => {
	form_group_melayang.classList.toggle('show');
	dropdownProfile.classList.remove('show');
})




// MENU
const allMenu = document.querySelectorAll('main .content-data .head .menu');

allMenu.forEach(item=> {
	const icon = item.querySelector('.icon');
	const menuLink = item.querySelector('.menu-link');

	icon.addEventListener('click', function () {
		menuLink.classList.toggle('show');
	})
})



window.addEventListener('click', function (e) {
	if (!profile.contains(e.target)) {
		dropdownProfile.classList.remove('show');
	}

	allMenu.forEach(item => {
		const menuLink = item.querySelector('.menu-link');

		if (!item.contains(e.target)) {
			menuLink.classList.remove('show');
		}
	});
})





// PROGRESSBAR
const allProgress = document.querySelectorAll('main .card .progress');

allProgress.forEach(item=> {
	item.style.setProperty('--value', item.dataset.value)
})


document.querySelectorAll('#btn-delete').forEach(btn => {
  btn.addEventListener('click', function (e) {
    const text = this.dataset.pesan;

    if (!confirm(text)) {
      e.preventDefault(); // STOP submit
    }
  });
});