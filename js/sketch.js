function toggleDarkMode(){
    if(document.cookie == "darkmode"){
        document.getElementsByTagName("body")[0].style.backgroundColor = "#111";
        document.getElementsByTagName("body")[0].style.color = "#ddd";
    }
}
