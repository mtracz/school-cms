function LayoutBuilder(){var e=this;this.build=function(){e.toggleElementsBasedOnViewportGroup(),e.sizeContentSector()},this.sizeContentSector=function(){e.toggleSectors();var t=$(".row_container > :not(.hideElement)").length;switch(console.log("Enabled sectors: "+t),t){case 1:$("#content_sector").removeClass().addClass("sixteen wide column sector");try{window.localStorage.setItem("newsWidth","sixteen")}catch(e){}break;case 2:$("#content_sector").removeClass().addClass("thirteen wide column sector");try{window.localStorage.setItem("newsWidth","thirteen")}catch(e){}break;case 3:$("#content_sector").removeClass().addClass("ten wide column sector");try{window.localStorage.setItem("newsWidth","ten")}catch(e){}}},this.toggleSectors=function(){$(".sector").each(function(){"bottom_sector"==$(this).attr("id")?0==$(this).find(".ui.grid").children().length?$(this).addClass("hideElement"):$(this).removeClass("hideElement"):0==$(this).children().length?$(this).addClass("hideElement"):$(this).removeClass("hideElement")})},this.toggleElementsBasedOnViewportGroup=function(){var t=e.specifyCurrentViewportGroupName();e.saveToLocalStorage(t),console.log("ViewportGroupName : "+t),$(".view_marker").each(function(e){console.log("view_marker element:",$(this)),$(this).hasClass(t)?($(this).hasClass("sector")||$(this).addClass("sector"),$(this).removeClass("hideElement")):($(this).hasClass("sector")&&$(this).removeClass("sector"),$(this).addClass("hideElement"))})},this.specifyCurrentViewportGroupName=function(){var t,s=e.getViewportWidth();return viewportGroups.forEach(function(e,o){s>=e.min&&s<=e.max&&(t=e.name)}),t},this.saveToLocalStorage=function(e){try{window.localStorage.setItem("viewportGroupName",e)}catch(e){}},this.getViewportWidth=function(){return $(window).width()},this.message=function(){console.log(viewportGroups)}}