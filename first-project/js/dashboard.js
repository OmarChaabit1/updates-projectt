var sidebarIsOpen = true ; 

toggleBtn.addEventListener("click",(event)=>{
    event.preventDefault();

    if(sidebarIsOpen){

   

    dashboard_sidebar.style.width = "10%" ;
    dashboard_sidebar.style.transition = ".3s all";
    dashboard_content_container.style.width = "90%"; 
    dashboard_logo.style.fontSize = "36px";
    user_img.style.width="60px";
    menutext = document.getElementsByClassName("menutext");
    for(var i=0; i < menutext.length ; i++){
        menutext[i].style.display = "none";

    }
    document.getElementsByClassName("dashboard-menu-list")[0].style.textAlign= "center";
    sidebarIsOpen = false ;    
}
    else {
    dashboard_sidebar.style.width = "20%" ;
    dashboard_content_container.style.width = "80%"; 
    dashboard_logo.style.fontSize = "5rem";
    user_img.style.width="60px";
    menutext = document.getElementsByClassName("menutext");
    for(var i=0; i < menutext.length ; i++){
        menutext[i].style.display = "inline-block ";

    }
    document.getElementsByClassName("dashboard-menu-list")[0].style.textAlign= "left";   
    sidebarIsOpen = true ; 
}
});


// subemenu show / hide function : 

document.addEventListener('click', function(e){
    let clickedEl = e.target ; 
    
    if(clickedEl.classList.contains('showHideSubMenu')){
// for the subMenus
        let subMenu =  clickedEl.closest('li').querySelector('.subMenus');
//for the icon-right  
        let mainMenuIcon =  clickedEl.closest('li').querySelector('.icon_right');    
        
//close open menus 
        let subMenus = document.querySelectorAll('.subMenus');
        subMenus.forEach((sub)=>{
        if(subMenu != sub) sub.style.display='none';
});
//console.log(subMens); //l9ina 3 submenus li3nna 

    showHideSubMenu(subMenu,mainMenuIcon);
}
});
// showHideSubMenu function 
function showHideSubMenu(subMenu,mainMenuIcon){
    if(subMenu != null){
         
        if(subMenu.style.display == 'block') {
         subMenu.style.display="none";
         mainMenuIcon.classList.add('fa-angle-left');
         mainMenuIcon.classList.remove('fa-angle-down');
        }
        else {
         subMenu.style.display = 'block';
         mainMenuIcon.classList.remove('fa-angle-left');
         mainMenuIcon.classList.add('fa-angle-down');
        }
     }
}
        
// add / hide active class to menu 
// get the current page 
// use selector to get the current menu or submenu 
// add the actibr class 

        let pathArray = window.location.pathname.split('/');
        let curFile = pathArray[pathArray.length - 1 ]; 

        let curNav = document.querySelector('a[href="./' + curFile +'"]');
        curNav.classList.add('subMenuActive');

        let mainNav = curNav.closest('li.liMainMenu');
        mainNav.style.background = "#6571ff ";

        let subMenu = curNav.closest(".subMenus");

        let mainMenuIcon =  mainNav.querySelector('i.icon_right');    

        showHideSubMenu(subMenu,mainMenuIcon);