// Funções JavaScript para a CasaDireta

document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll para links internos
    const internalLinks = document.querySelectorAll('a[href^="#"]');
    
    internalLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const offsetTop = targetElement.offsetTop - 80; // Considera a navbar fixa
                
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Validação do formulário de busca
    const searchForm = document.querySelector('.search-form');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            const cidade = this.querySelector('input[name="cidade"]').value.trim();
            const tipo = this.querySelector('select[name="tipo"]').value;
            const transacao = this.querySelector('select[name="transacao"]').value;
            
            if (!cidade || !tipo || !transacao) {
                e.preventDefault();
                alert('Por favor, preencha todos os campos da busca.');
            }
        });
    }

    // Máscara para telefone no formulário de cadastro
    const telefoneInput = document.getElementById('telefone');
    if (telefoneInput) {
        telefoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            
            if (value.length <= 11) {
                value = value.replace(/(\d{2})(\d)/, '($1) $2');
                value = value.replace(/(\d{5})(\d)/, '$1-$2');
            }
            
            e.target.value = value;
        });
    }

    // Máscara para CPF no formulário de cadastro
    const cpfInput = document.getElementById('cpf');
    if (cpfInput) {
        cpfInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            
            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            }
            
            e.target.value = value;
        });
    }

    // Formatação de preço no formulário de cadastro
    const precoInput = document.getElementById('preco');
    if (precoInput) {
        precoInput.addEventListener('focus', function() {
            this.value = this.value.replace(/[^\d]/g, '');
        });
        
        precoInput.addEventListener('blur', function() {
            const value = parseInt(this.value.replace(/[^\d]/g, ''));
            if (!isNaN(value)) {
                this.value = value.toLocaleString('pt-BR');
            }
        });
    }

    // Animação de scroll para as seções
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observar elementos para animação
    const animatedElements = document.querySelectorAll('.step, .owner-text, .owner-image');
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });

    // Feedback de envio de formulário
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = 'Enviando...';
                submitBtn.disabled = true;
            }
        });
    });
});

// Função para buscar CEP (exemplo de funcionalidade futura)
function buscarCEP(cep) {
    cep = cep.replace(/\D/g, '');
    
    if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById('endereco').value = `${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`;
                }
            })
            .catch(error => {
                console.error('Erro ao buscar CEP:', error);
            });
    }
}