export function maskedString(originalString, hideChars = 2, maskCharacter = 'x') {
  let strLen = originalString.length;

  if (strLen - hideChars < 1) {
    return originalString[0] + "xx";
  }else{
    const visibleString = originalString.substr(0, strLen-hideChars);

    const maskString = maskCharacter.repeat(hideChars);

    return visibleString + maskString;
  }

  return originalString;
}
