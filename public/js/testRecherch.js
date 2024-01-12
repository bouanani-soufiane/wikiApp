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
                    let wiki = xhr.response;
                    console.log(JSON.parse(wiki));
                    searchWiki(searchValue, (wikiData) => {
                        if (wikiData) {
                            let wiki = JSON.parse(wikiData);

                            console.log(wiki);
                            showResults(wiki);
                        } else {
                            console.log("Failed to fetch wiki data");
                        }
                    });
                } else {
                    console.error(xhr.statusText);
                }
            }
        };
        xhr.onerror = (e) => {
            console.error(xhr.statusText);
            alert("Failed to fetch wiki data. Please try again later.");

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

    xhr.open("POST", "/wikiApp/wikis/getwikis", true);
    xhr.send(data);
}

function showResults(wikis) {
    let searchValue = searchBar.value;

    content.innerHTML = `
    <div class="mt-4 flex items-center justify-center ">
        <div class="flex space-x-4 ">
            <h1 class="block font-medium px-2 text-5xl sm:text-5xl md:text-6xl lg:text-5xl">
                wikis par titre</h1>
        </div>
    </div>
        <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
        <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">
        
      ${wikis.map((wikidata) => `  
               
                <div class="rounded overflow-hidden shadow-lg">
                     <a href="/wikiApp/public/Wikis/showSingle/${wikidata.id}">
                        <div class="relative">
                        <img class="w-full" src="/wikiApp/public/../img/${wikidata.image}" alt="Sunset in the mountains">

                            <div class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25"></div>
                            <a href="/wikiApp/public/Wikis/showSingle/${wikidata.id}">
                                <div class="absolute bottom-0 left-0 bg-black  px-4 py-2 text-white text-sm hover:bg-white hover:text-black transition duration-500 ease-in-out">
                                    ${wikidata.Category.name}
                                </div>
                            </a>
                            <a href="/wikiApp/public/Wikis/showSingle/${wikidata.id}">
                                <div class="text-sm absolute top-0 right-0 bg-black px-4 text-white rounded-full h-16 w-16 flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-black transition duration-500 ease-in-out">
                                    <span class="font-bold">27</span>
                                    <small>March</small>
                                </div>
                            </a>
                        </div>
                    </a>
                    <div class="px-6 py-4">
                        <a href="/wikiApp/public/Wikis/showSingle/${wikidata.id}" class="font-semibold text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out">                                    ${wikidata.Titre}
</a>
                        <p class="text-gray-500 text-sm">

                        </p>
                    </div>
                    <div class="px-6 py-4 flex flex-row items-center">
                <span href="<?php echo URLROOT; ?>/Wikis/showSingle/<?php echo $wiki->getId();?>" class="py-1 text-sm font-regular text-gray-900 mr-1 flex flex-row items-center">
                    <svg height="13px" width="13px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256
\t\t\tc0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128
\t\t\tc0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z" />
                            </g>
                        </g>
                    </svg>
                    <span class="ml-1"><?php echo calculateReadingTime($wiki->3 mins reading</span></span>
                    </div>
                </div>
                
                
`
        )
        .join("")}
              
          </div>


        </div>
    </div>
    <div class="mt-4 flex items-center justify-center ">
        <div class="flex space-x-4 ">
            <h1 class="block font-medium px-2 text-5xl sm:text-5xl md:text-6xl lg:text-5xl">
                category par Name</h1>
        </div>
    </div>
    <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
        <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">
       ${wikis.map((wikidata) => `
                    <div class="rounded ">
                    <a href="/wikiApp/public/Wikis/showWikiCateg/${wikidata.Category.id}">
                        <div class="relative h-full">
                        
                            <img class="w-full" src="/wikiApp/public/../img/${wikidata.Category.image}"alt="">
                            <div class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25"></div>
                               <a href="/wikiApp/public/Wikis/showWikiCateg/${wikidata.Category.id}">

                                <div class="absolute w-full bottom-0 left-0 bg-black  px-4 py-4 text-white text-md text-center hover:bg-white hover:text-black transition duration-500 ease-in-out">
                                           ${wikidata.Category.name}
                                </div>
                            </a>
                        </div>
                    </a>
                </div>
            
            `
        )
        .join("")}
          </div>
    </div>
    `;
}
