const filesSelectedElem = document.getElementById('images-preview');

function renderImages(whatToRender = '', inputFiles)
{
    let whereToRender = '';
    switch (whatToRender) {
        case 'preview':
            whereToRender = 'theme-preview';
            break;
        
        case 'images':
            whereToRender = 'images-preview';
            break;

        default:
            break;
    }

    for (const key in inputFiles) {
        if (inputFiles.hasOwnProperty(key)) {
            const element = inputFiles[key];
            const reader = new FileReader();
            reader.readAsDataURL(element);

            reader.onloadend = function () {
                let img = new Image();
                img.classList.add('preview-image');

                if (whatToRender === 'preview')
                {
                    img.id = 'image-theme-preview';
                }

                img.src = reader.result;
                document.getElementById(whereToRender).insertAdjacentElement('beforeend', img)
            }
        }
    }
}

function renderError (message = '', whereToRender) {
    whereToRender.insertAdjacentHTML('beforebegin', `<p class="error-message" style="margin: unset">${message}</p>`);
    
    filesSelectedElem.innerHTML = '';
    
    setInterval( () => {
        clearErrors();
    }, 5000)
}

function clearErrors ()
{
    if (document.querySelector('p.error-message'))
    {
        document.querySelector('p.error-message').remove();
    }
}


document.getElementById('themeImages').addEventListener('change', event => {
    const files = event.target.files;

    if (document.getElementById('images-preview').childNodes.lengt !== 0)
    {
        if(document.getElementById('images-preview').childNodes.length - 1 + files.length < 5)
        {
            if (files.length < 5)
            {
                clearErrors();
                renderImages('images', files);

            } else
            {
                renderError('Вы можете выбрать не более 4 файлов', filesSelectedElem);
            }
        }
        else
        {
            renderError('Вы можете выбрать не более 4 файлов', filesSelectedElem);
        }
    }
    else
    {
        renderError('Вы можете выбрать не более 4 файлов', filesSelectedElem);
    }
    
})

let preview;

document.getElementById('themePreview').addEventListener('change', event => {
    preview = event.target.files;
    renderImages('preview', preview);
})

function themePreview(event)
{
    event.preventDefault();

    if (document.querySelector('div.theme'))
    {
        document.querySelector('div.theme').remove();
    }
    
    const themeDesc = document.getElementById('themeDesc').value.trim();
    const themeName = document.getElementById('themeName').value;

    if (themeDesc!=='' && themeName!=='' && preview !== {})
    {
        const date = new Date();
        let day = date.getDate().toString().length === 1 ? `0${date.getDate()}` : date.getDate();
        console.log('day: ', day);
        let month = date.getMonth().toString().length === 1 ? `0${date.getMonth()}` : date.getMonth();
        console.log('month: ', month);
        let hours = date.getHours().toString().length === 1 ? `0${date.getHours()}` : date.getHours();
        console.log('hours: ', hours);
        let minutes = date.getMinutes().toString().length === 1 ? `0${date.getMinutes()}` : date.getMinutes();
        console.log('minutes: ', minutes);

        let user = document.querySelector('a.login-button').textContent;
        const previewImage = document.getElementById('image-theme-preview');

        console.log(previewImage);
    
        document.getElementById('preview-theme').insertAdjacentHTML('afterend', 
        `
        <div class="theme" style="width: 33%; margin-top: 20px;">

            <div class="theme-preview" style="background-image: url('${previewImage.src}')"></div>

            <h3 class="theme-name">${themeName}</h3>

            <span class="theme-author mainpage-author">Автор - ${user}</span>

            <span class="theme-date mainpage-date">${day}.${month}.${date.getFullYear()} в ${hours}:${minutes}</span>

            <p class="theme-text">${themeDesc}</p>
            <span class="theme-comments">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="25px" height="25px">
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M21.99 4c0-1.1-.89-2-1.99-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4-.01-18z"/>
                </svg>
                0 ответов в теме
            </span>
        </div>
        `);
    }
    else 
    {
        renderError('Заполните все обязательные поля', filesSelectedElem)
    }
    
}

document.getElementById('preview-theme').addEventListener('click', themePreview);