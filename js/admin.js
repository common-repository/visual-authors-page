/* START events */
var vap_tags = document.getElementById("vap_tags");

var roles = document.getElementById("roles");
var rolues_value = document.getElementById("roles_value");

if (roles) {
    roles.addEventListener("click", function(){
        rolues_value.disabled = !roles.checked;
        genValues();
    });
}

if (rolues_value) {
    rolues_value.addEventListener("change", genValues);
    rolues_value.addEventListener("keydown", genValues);
    rolues_value.addEventListener("cut", genValues);
    rolues_value.addEventListener("paste", genValues);
}

var authors = document.getElementById("authors");
var authors_value = document.getElementById("authors_value");

if (authors){
    authors.addEventListener("click", function(){
        authors_value.disabled = !authors.checked;
        genValues();
    });
}

if (authors_value) {
    authors_value.addEventListener("change", genValues);
    authors_value.addEventListener("keydown", genValues);
    authors_value.addEventListener("cut", genValues);
    authors_value.addEventListener("paste", genValues);
}

var counter = document.getElementById("counter");
var counter_value = document.getElementById("counter_value");
if (counter){
    counter.addEventListener("click", function(){
        counter_value.disabled = !counter.checked;
        genValues();
    });
}

if (counter_value) {
    counter_value.addEventListener("change", genValues);
    counter_value.addEventListener("keydown", genValues);
    counter_value.addEventListener("cut", genValues);
    counter_value.addEventListener("paste", genValues);
}

var bio = document.getElementById("bio");
if (bio){
    bio.addEventListener("click", function(){
        genValues();
    });
}

var avatar = document.getElementById("avatar");
if (avatar){
    avatar.addEventListener("click", function(){
        genValues();
    });
}

var border = document.getElementById("border");
if (border){
    border.addEventListener("click", function(){
        genValues();
    });
}
/* END events */

function attachValue(tagBox, key, el) {
    tagBox.value = tagBox.value.slice(0, tagBox.value.length-1)+' ' + key;
    if (el !== null) {
        tagBox.value += '="'+el.value+'"';
    }
    tagBox.value += ']';
}

function genValues() {

    vap_tags.value = "[vauthors_page]";

    if(roles.checked) {
        attachValue(vap_tags, 'roles', rolues_value);
    }

    if(authors.checked) {
        attachValue(vap_tags, 'authors', authors_value);
    }

    if(counter.checked) {
        attachValue(vap_tags, 'counter', counter_value);
    }

    if(bio.checked) {
        attachValue(vap_tags, "bio", null);
    }
    if(avatar.checked) {
        attachValue(vap_tags, "avatar", null);
    }

    if(border.checked) {
        attachValue(vap_tags, "border", null);
    }

}