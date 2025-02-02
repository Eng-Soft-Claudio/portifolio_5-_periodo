// Função para alternar entre modo claro e escuro
document.getElementById("darkModeToggle").addEventListener("change", function() {
    if (this.checked) {
        document.body.classList.replace('light-mode', 'dark-mode');
        localStorage.setItem('theme', 'dark');
    } else {
        document.body.classList.replace('dark-mode', 'light-mode');
        localStorage.setItem('theme', 'light');
    }
});

// Verificar a preferência do usuário ao carregar a página
window.addEventListener("DOMContentLoaded", () => {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.replace('light-mode', 'dark-mode');
        document.getElementById("darkModeToggle").checked = true;
    }
});
