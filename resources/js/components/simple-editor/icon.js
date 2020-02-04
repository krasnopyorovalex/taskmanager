export const createIcon = (text) => {
  const icon = document.createElement('div');
  //icon.className = className;
  icon.innerHTML = text;

  return icon;
};
