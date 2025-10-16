document.addEventListener('DOMContentLoaded',()=>{

    const btn = document.getElementById('genBtn');

    const area = document.getElementById('linkArea');

    if(btn) btn.onclick = async ()=>{

        const res = await fetch(ajaxUrl);

        const data = await res.json();

        if(data.ok){

            area.innerHTML = `🔗 Open this link to complete task: <a href="${data.short}" target="_blank">${data.short}</a>`;

        } else alert('Error generating task');

    };

});