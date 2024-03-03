/*Genera un número entero aleatorio*/
export function getRndInteger(min, max){ return Math.floor(Math.random() * (max - min + 1) ) + min;}
