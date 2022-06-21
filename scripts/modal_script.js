document.addEventListener('DOMContentLoaded', function () {
    const modal = document.querySelectorAll('.rename_modal');


    let isOpen = false;
    let prevOpen = '';
    for (let i = 0; i < modal.length; i++) {
        modal[i].addEventListener('click', function handlerOnClick(e) {
            for (let i = 0; i < modal.length; i++) {
                const modalWindow = document.querySelector(`.modal_${i}`);
                modalWindow.classList.remove("is_open");
            }
            const modalWindow = document.querySelector(`.modal_${i}`);
            if (prevOpen == modalWindow) {
                console.log(prevOpen);
                if (isOpen == true) {
                    isOpen = false;   
                    prevOpen = '';          
                    return;
                }
                prevOpen = '';
            } else {
                prevOpen = modalWindow;
                const modalExit = document.querySelector(`.exitModal_${i}`);
                modalWindow.classList.toggle("is_open");
                isOpen = true;
                modalExit.addEventListener('click', (e) => {
                    e.stopPropagation();
                    isOpen = false;
                    prevOpen = ''; 
                    modalWindow.classList.remove("is_open");
                })
            }

        });
    }
})
