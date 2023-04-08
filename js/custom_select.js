
const selectMenus = document.querySelectorAll('.custom-select');

selectMenus.forEach((optionMenu) => {
    const selectBtn = optionMenu.querySelector('.select-btn');
    const menuOptions = optionMenu.querySelectorAll('.option');
    const sBtnText = optionMenu.querySelector('.sbtn-text');

    selectBtn.addEventListener('click', () => {
        // Toggle the active-select class only for the current select menu
        optionMenu.classList.toggle('active-select');
    });

    menuOptions.forEach((option) => {
        option.addEventListener('click', () => {

        const prevActive = optionMenu.querySelector('.active');
        if (prevActive) {
            prevActive.classList.remove('active');
        }
        let selectedOption = option.querySelector('.option-text').innerText;
        //option.classList.add('active');
        sBtnText.innerText = selectedOption;

        // Remove the active-select class only for the current select menu
        optionMenu.classList.remove('active-select');

        });
    });
    

    document.addEventListener('click', function (event) {
        // If the click is not inside the select button or the options menu, remove the active-select class
        if (!event.target.matches('.select-btn') && !event.target.closest('.custom-select')) {
        optionMenu.classList.remove('active-select');
        }
    });
});
   