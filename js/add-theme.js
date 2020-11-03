const filesSelectedElem = document.querySelector('.image-preview');
document.getElementById('themeThumbnail').addEventListener('change', event => {
    let files = event.target.files;

    if (files.length >= 5)
    {
        filesSelectedElem.insertAdjacentHTML('beforebegin', `<p class="error-message" style="margin: unset">Вы можете выбрать не более 4 файлов</p>`);
        filesSelectedElem.innerHTML = '';

        setInterval( () => {
            clearErrors();
        }, 5000)

    } else
    {
        if (document.querySelector('p.error-message'))
        {
            document.querySelector('p.error-message').remove();
        }

        for (const key in files) {
            if (files.hasOwnProperty(key)) {
                const element = files[key];

                let reader = new FileReader();
                reader.readAsDataURL(element);

                reader.onloadend = function () {
                    let img = new Image();
                    img.classList.add('preview-image');
                    img.src = reader.result; 
                    document.querySelector('div.image-preview').insertAdjacentElement('beforeend', img)
                }
            }
        }
    }
})

function clearErrors ()
{
    if (document.querySelector('p.error-message'))
    {
        document.querySelector('p.error-message').remove();
    }
}

function themePreview(event)
{
    event.preventDefault();
    
    const themeDesc = document.getElementById('themeDesc').value.trim();
    const themeName = document.getElementById('themeName').value;

    if (themeDesc!=='' && themeName!=='')
    {
        const date = new Date();
        let day = date.getDay().toString().length=== 1 ? `0${date.getDay()}` : date.getDay();
        let month = date.getMonth().toString().length === 1 ? `0${date.getMonth()}` : date.getMonth();
        let hours = date.getHours().toString().length === 1 ? `0${date.getHours()}` : date.getHours();
        let minutes = date.getMinutes().toString().length === 1 ? `0${date.getMinutes()}` : date.getMinutes();

        let user = document.querySelector('a.login-button').textContent;
        const images = document.querySelectorAll('img.preview-image');
    
        document.getElementById('preview-theme').insertAdjacentHTML('afterend', 
        `
        <div class="theme" style="width: 100%; margin-top: 20px;">
    
            <h3 class="theme-name">
                ${themeName}
                <span class="theme-date">${day}.${month}.${date.getFullYear()} в ${hours}:${minutes}</span>
            </h3>
    
            <span class="theme-author">Автор - ${user}</span>
    
            <div class="img-wrapper"></div>
    
            <p class="theme-text">${themeDesc}</p>
    
            <span class="theme-comments">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="25px" height="25px">
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M21.99 4c0-1.1-.89-2-1.99-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4-.01-18z"/>
                </svg>
                0 ответов в теме
            </span>
        </div>
        `)
    
        images.forEach(item => {
        
            let image = new Image();
            image.src = item.src;
            image.classList.add('theme-sumbnail');
            console.log(image);
            document.querySelector('div.img-wrapper').insertAdjacentElement('beforeend', image);
        })
    }
    else 
    {
        filesSelectedElem.insertAdjacentHTML('beforebegin', `<p class="error-message" style="margin: unset">Заполните все обязательные поля</p>`);
        setInterval( () => {
            clearErrors();
        }, 5000)
    }
    
}

document.getElementById('preview-theme').addEventListener('click', themePreview);