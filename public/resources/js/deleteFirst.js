        /*
        Elimina el primero de la lista
        */
        export function deleteFirst(cssProp){
            let objList = document.querySelectorAll(cssProp);
            if(objList.length != 0){objList[0].parentNode.removeChild(objList[0]);}
        }