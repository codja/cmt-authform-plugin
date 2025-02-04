import {Constants} from "../Constants.js";

export default () => {
	const containers = document.querySelectorAll('.js-select-list');
	if (!containers.length) {
		return null;
	}

	for (const container of containers) {
		const current = container.querySelector('.js-select-list-current');
		const select = container.querySelector('.js-select-list-select');
		const list = container.querySelector('.js-select-list-list');

		if (!current || !select || !list) {
			continue;
		}

		const options = Array.from(select.options);
		if (!options.length) {
			continue;
		}

		// Создаем поле поиска
		const searchInput = document.createElement('input');
		searchInput.classList.add('rgbcode-authform-select__search');
		searchInput.type = 'search';
		searchInput.autocomplete = 'off';
		searchInput.role = 'textbox';
		list.appendChild(searchInput);

		// Устанавливаем начальное значение
		const updateCurrentSelection = () => {
			const selectedOption = select.selectedOptions[0];
			current.innerHTML = `<img src="${Constants.imgFlagsPath}${selectedOption.value.toLowerCase()}.svg" alt=""><span>${selectedOption.label}</span>`;
		};
		updateCurrentSelection();

		const ul = document.createElement('ul');
		ul.classList.add('select-list__list');
		const fragment = document.createDocumentFragment();

		options.forEach((option) => {
			const li = document.createElement('li');
			li.classList.add('select-list__item');
			li.textContent = option.label;
			fragment.appendChild(li);
		});

		ul.appendChild(fragment);
		list.appendChild(ul);

		const listItems = ul.querySelectorAll('.select-list__item');
		ul.addEventListener('click', (event) => {
			const item = event.target.closest('.select-list__item');
			if (!item) return;

			const optionToSelect = options.find((option) => option.label===item.textContent);
			if (!optionToSelect) return;

			optionToSelect.selected = true;
			select.dispatchEvent(new Event('change'));

			updateCurrentSelection();
			container.classList.remove('rgbcode-active');
		});

		current.addEventListener('click', () => {
			container.classList.toggle('rgbcode-active');
		});

		document.addEventListener('click', (e) => {
			if (!container.contains(e.target)) {
				container.classList.remove('rgbcode-active');
			}
		});

		searchInput.addEventListener('input', (e) => {
			const searchText = e.target.value.toLowerCase();
			for (const item of listItems) {
				const text = item.textContent.toLowerCase();
				item.classList.toggle(Constants.hideClass, !text.includes(searchText));
			}
		});
	}
}
