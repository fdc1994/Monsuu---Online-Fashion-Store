function getSearch(selectObject) {
    var value = selectObject.value;  
    updateSearchParameters(value);
}

function updateSearchParameters(value) {

var url = new URL(window.location.href);
url.searchParams.set('orderBy=',value);
window.location.href = url.href;
}
