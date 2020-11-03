const filesSelectedElem = document.querySelector('.image-preview');
document.getElementById('themeThumbnail').addEventListener('change', event => {
    let files = event.target.files;

    if (files.length >= 5)
    {
        filesSelectedElem.insertAdjacentHTML('beforebegin', `<p class="error-message" style="margin: unset">Вы можете выбрать не более 4 файлов</p>`);
        filesSelectedElem.innerHTML = '';
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

function themePreview(event)
{
    event.preventDefault();
    const date = new Date();
    const images = document.querySelectorAll('img.preview-image');
    const themeDesc = document.getElementById('themeDesc').value;
    const themeName = document.getElementById('themeName').value;
    document.querySelector('form.add-theme-form').insertAdjacentHTML('afterend', 
    `
    <div class="theme">

        <h3 class="theme-name">
            ${themeName}
            <span class="theme-date">${date.getDay()}.${date.getMonth()}.${date.getFullYear()} в ${date.getHours()}:${date.getMinutes()}</span>
        </h3>

        <span class="theme-author">Автор - Вы</span>

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

document.getElementById('preview-theme').addEventListener('click', themePreview);