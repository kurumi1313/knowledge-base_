function showInstructions(data = []) {
    let localData = localStorage.getItem('s');

    if (localData === null && data.length > 0) {
        localStorage.setItem('s', JSON.stringify(data));
    }

    if (localData !== null) {
        const block = document.querySelector('.post-wrap');
        localData = JSON.parse(localData);

        let content = '';

        for(let i = 0; i < localData.length; i++) {
            content += `<div class="post-item">
                            <div class="post-item-wrap">
                                <div class="post-title">
                                    ${localData[i].header}
                                </div>
                                <div class="text-wrapper-block">
                                    <div class="text-wrapper">
                                        <a href="/instruction/${localData[i].id}" class="post-link">
                                            <p class="theme">${localData[i].theme}</p>
                                            <p class="details">Нажмите, чтобы открыть</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>`;
        }

        block.innerHTML = content;

        localStorage.removeItem('s');
    }

}