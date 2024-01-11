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
                    let artists = xhr.response;
                    searchMusic(searchValue, (musicData) => {
                        if (musicData) {
                            let music = JSON.parse(musicData);
                            artists = JSON.parse(artists);
                            console.log(artists);
                            console.log(music);
                            showResults(artists, music);
                        } else {
                            console.log("Failed to fetch music data");
                        }
                    });
                } else {
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
        xhr.open("POST", "/paroly/public/home/getArtists", true);
        xhr.send(data);
    }
});
function searchMusic(searchValue, callback) {
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

    xhr.open("POST", "/paroly/public/home/getMusic", true);
    xhr.send(data);
}

function showResults(artists, music) {
    content.innerHTML = `<div class="flex flex-col items-center justify-evenly h-full pb-2">
  <div class="flex flex-col items-center justify-center w-full h-full lg:min-h-[50vh] lg:flex-row">
      <div class="w-full lg:w-2/5 flex flex-col items-start justify-start gap-4 h-full my-2 p-4 md:my-auto">
          <p class="text-lg font-bold">Top Result</p>
          <div class="flex flex-col gap-4 justify-center items-center rounded-lg w-full h-[40vh] bg-gray-200 p-2">
              <a href="/paroly/public/music/index/${music[0].id}"><img src="/paroly/public/../assets/images/music/${
        music[0].image
    }" class=" object-contain h-32 w-32 rounded-lg" alt=""></a>
              <p class="text-2xl font-semibold">${music[0].name}</p>
              <p class="text-xl font-medium">${music[0].artist.name}</p>
          </div>
      </div>
      <div class="w-full lg:w-3/5 flex flex-col items-start justify-between h-full my-2 p-4 md:my-auto">
          <p class=" indent-16 text-lg font-bold">Songs</p>
          <div class="flex flex-col gap-4 items-center justify-center w-full h-full p-2">
          ${music
        .map(
            (
                musicData
            ) => `<a href="/paroly/public/music/index/${musicData.id}" class="w-[85%]">
          <div class="flex w-[98%] mx-auto items-center justify-between shadow-lg border-t-2 border-b-0 rounded-lg px-2">
              <div class="flex items-center gap-12">
                  <img src="/paroly/public/../assets/images/music/${musicData.image}" class="object-contain h-16 py-1" alt="">
                  <div class="flex flex-col items-start justify-start">
                      <p>${musicData.name}</p>
                      <p>${musicData.date}</p>
                  </div>
              </div>
              <p>By ${musicData.artist.name}</p>
          </div>
      </a>`
        )
        .join("")}
          </div>
      </div>
  </div>
  <div class="flex flex-col items-start justify-start w-full h-full lg:h-[40vh]">
      <p class="indent-4 text-lg font-bold py-2">Artists</p>
      <div class="flex flex-wrap items-center justify-evenly lg:justify-start w-full lg:pl-4 gap-3">
      ${artists
        .map(
            (artistData) => `
        <div class="flex flex-col justify-between items-center sm:w-1/2 md:w-1/4 lg:w-[14%] p-2 pb-1 rounded-xl bg-gray-300">
          <img src="/paroly/public/../assets/images/profile/${artistData.image}" class=" object-cover h-36 w-36 rounded-full" alt="">
          <p class="self-start pt-2">${artistData.name}</p>
        </div>`
        )
        .join("")}
          
      </div>
  </div>
    </div>`;
    }