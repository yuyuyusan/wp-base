// humburger menu
const menuBox: HTMLElement = document.querySelector('.menuBox') as HTMLElement;
const menuElements: {
  top: HTMLElement;
  center: HTMLElement;
  bottom: HTMLElement;
  headerInner: HTMLElement;
} = {
  top: document.querySelector('.menuTop') as HTMLElement,
  center: document.querySelector('.menuCenter') as HTMLElement,
  bottom: document.querySelector('.menuBottom') as HTMLElement,
  headerInner: document.querySelector('.humburgerContents') as HTMLElement,
};

const toggleMenu = (): void => {
  for (const element of Object.values(menuElements)) {
    element.classList.toggle('js-active');
  }
};

menuBox.addEventListener('click', toggleMenu);