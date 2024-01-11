let content = document.getElementById("content");
let searchBar = document.getElementById("search");
let oldContent = content.innerHTML;


searchBar.addEventListener("input", () => {
    let searchValue = searchBar.value;
    if (searchValue == "") {
        content.innerHTML = oldContent;
    } else {
        let xhr = new XMLHttpRequest();
        xhr.onload = (e) => {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    let user = xhr.response;
                    searchWiki(searchValue, (wikiData) => {
                        if (wikiData) {
                            let wiki = JSON.parse(wikiData);
                            user = JSON.parse(user);
                            console.log(user);
                            console.log(wiki);
                            showResults(user, wiki);
                        } else {
                            console.log("Failed to fetch wiki data");
                        }
                    });
                }else {
                    console.error(xhr.statusText);
                }
            }
        };
        xhr.onerror = (e) => {
            console.error(xhr.statusText);
        };
        let data = {
            search: searchValue,
        };
        data = JSON.stringify(data);
        xhr.open("POST", "/wikiApp/public/wikis/getwikis", true);
        xhr.send(data);
    }
});

function searchWiki(searchValue, callback) {
    let xhr = new XMLHttpRequest();
    xhr.onload = (e) => {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                let data = xhr.response;
                callback(data);
            } else {
                console.error(xhr.statusText);
                callback(null);
            }
        }
    };
    xhr.onerror = (e) => {
        console.error(xhr.statusText);
        return xhr.statusText;
    };

    let data = {
        search: searchValue,
    };

    data = JSON.stringify(data);

    xhr.open("POST", "/wikiApp/public/wikis/getwikis", true);
    xhr.send(data);
}


function showResults(artists, music) {
    content.innerHTML = `<div class="flex flex-col items-center justify-evenly h-full pb-2">
            hello world
    </div>`;
}