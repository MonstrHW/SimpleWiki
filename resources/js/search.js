let search = document.getElementById("search");
search.onkeyup = enterSearch;

let timeout = null;

function enterSearch() {
    if (timeout) {
        clearTimeout(timeout);
    }

    timeout = setTimeout(doSearch, 500, this.value);
}

function clearSearchResult() {
    document.getElementById("search_result").innerHTML = "";
}

function doSearch(s) {
    if (s.trim().length === 0) {
        clearSearchResult();

        return;
    }

    axios
        .get("/search/" + s.trim())
        .then((res) => {
            showSearchResult(res.data);
        })
        .catch((err) => {
            console.log(err);
        });
}

function showSearchResult(result) {
    clearSearchResult();

    let formatLink = (url, header) =>
        `<a href="${url}" class="hover:bg-slate-800 px-4 py-1">${header}</a>`;

    let searchResult = document.getElementById("search_result");

    for (const r of result) {
        searchResult.innerHTML += formatLink(r.url, r.header);
    }
}
