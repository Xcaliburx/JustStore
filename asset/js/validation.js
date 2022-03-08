function regisvalid(){
    var Name = document.getElementById("name").nodeValue;

    if(Name.length < 3){
        alert('nama minimal 3 huruf');
    }
}