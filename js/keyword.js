/* LANG */
const numLang = document.getElementById("NumLang");

/*  KEYWORD */
const select = document.querySelector("#keyWordSelect");
const list = document.getElementById("keyWordList");
const keywordCount = document.getElementById("keywordCount");
const keywordsInput = document.getElementById("Keywords");

/* Vars */
var keywords = new Array();
var options = new Array();
var selectLang = null;

function saveAllOptions() {
    var child = select.lastElementChild;  
    while (child) {
        let lang = child.dataset.lang;
        if(!options[lang])options[lang] = new Array();
        options[lang].push({
            value: child.value,
            lib: child.innerHTML
        });
        select.removeChild(child); 
        child = select.lastElementChild;
    }
}

saveAllOptions();

document.addEventListener('click', function (event) {
    if(event.target != null) {
        if(event.target.id == "addKeyWordButton") {
            event.preventDefault();
            addSelectedElmt(event);
            updateList();
            updateOptions();
        }else if(event.target.classList.contains("removeKeyWord")){
            event.preventDefault();
            removeClickedElmt(event);
            updateList();
            updateOptions();
        }

    } 
});

numLang.addEventListener("change", function(event) {
    updateLangValue();
    updateList();
});

function removeClickedElmt(event) {
    let li = event.target.parentNode;
    let ul = li.parentNode;
    let index = Array.prototype.indexOf.call(ul.children, li);
    let keyword = getKeywordArray()[index];
    getKeywordArray().splice(index, 1);
}

function addSelectedElmt(event) {
    var selected = select.options[select.selectedIndex];
    if(selected) {
        getKeywordArray().push({value: selected.value, lib: selected.text});
        selected.remove();
    }
}

function updateList() {
    clearList(list);
    getKeywordArray().forEach(keyword => {
        list.appendChild(getLI(keyword.lib)); 
    });
    keywordCount.innerHTML = getKeywordArray().length;
    keywordsInput.value = getSerialiedKeyword();
}

function updateOptions() {
    clearList(select);

    let options = getOptionsArray();
    let availableOptions = new Array();
    let keywords = getKeywordArray();
    for (let option of options) {
        let add = true;
        for (let keyword of keywords) {
            if(keyword.value == option.value) {
                add =false;
                break;
            }
        }
        if(add)availableOptions.push(option);
    }
    availableOptions.forEach(option => {
        select.appendChild(getOption(option)); 
    });
}

function clearList(list) {
    var child = list.lastElementChild;  
    while (child) { 
        list.removeChild(child); 
        child = list.lastElementChild; 
    } 
}

function getOption(keyword) {
    var option = document.createElement("option");
    var optionContent = document.createTextNode(keyword.lib);
    option.appendChild(optionContent);
    option.value = keyword.value;
    
    return option;
}

function getLI(content) {
    var li = document.createElement("li");
    var newContent = document.createTextNode(content);
    li.appendChild(newContent);
    li.classList.add("list-group-item");
    li.classList.add("d-flex");
    li.classList.add("justify-content-between");
    li.classList.add("align-items-center");

    var button = document.createElement("button");
    var buttonContent = document.createTextNode("Remove");
    button.appendChild(buttonContent);
    button.classList.add("btn");
    button.classList.add("btn-danger");
    button.classList.add("removeKeyWord");

    li.appendChild(button);

    return li;
}


function getSerialiedKeyword() {
    return getKeywordArray().map(x => x.value).join(",");
}

function updateLangValue() {
    selectLang = numLang.options[numLang.selectedIndex].value;
    if(!keywords[selectLang])keywords[selectLang] = new Array();
    updateOptions();
}

function getKeywordArray() {
    return keywords[selectLang];
}
function getOptionsArray() {
    return options[selectLang];
}

updateLangValue();