// ------------------------------
// ハンバーガーメニュー
// ------------------------------
const menuBox = document.querySelector('.menuBox');
const menuTop = document.querySelector('.menuTop');
const mennuCenter = document.querySelector('.mennuCenter');
const menuBottom = document.querySelector('.menuBottom');
const headerNav = document.querySelector('.headerNav'); 
const logoHidden = document.querySelector('.logo.pc');
menuBox.addEventListener('click', () => {
  menuTop.classList.toggle('active');
  mennuCenter.classList.toggle('active');
  menuBottom.classList.toggle('active');
  headerNav.classList.toggle('active');
  logoHidden.classList.toggle('active');
});