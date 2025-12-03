@extends('layouts.app')

@section('title', 'Sobre')

@section('content')
<div class="container py-5">
    <div class="row mb-6">
        <div class="col-lg-10 mx-auto text-center position-relative">
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
            </div>
            <h1 class="display-4 fw-bold gradient-text mb-4 animate-on-scroll">Sobre o Projeto</h1>
            <p class="lead text-muted mb-4 animate-on-scroll" data-delay="100">
                Conectando talentos excepcionais com oportunidades incríveis
            </p>
            <div class="progress-line mx-auto animate-on-scroll" data-delay="200"></div>
        </div>
    </div>

    <div class="row mb-6 align-items-stretch g-4"> 
        <div class="col-lg-6">
            <div class="vision-card h-100 animate-on-scroll">
                <div class="card-icon">
                    <i class="bi bi-lightbulb"></i>
                </div>
                <h3 class="fw-bold text-dark mb-3">Nossa Visão</h3>
                <p class="text-muted mb-4">
                    Criar uma plataforma que revolucione a forma como pessoas encontram e contratam serviços profissionais, 
                    promovendo confiança, transparência e qualidade em cada interação.
                </p>
                <div class="vision-stats">
                    <div class="stat-item">
                        <span class="stat-number" data-target="1000">0</span>
                        <span class="stat-label">Profissionais</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" data-target="5000">0</span>
                        <span class="stat-label">Clientes</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="mission-card h-100 animate-on-scroll" data-delay="100">
                <div class="card-icon">
                    <i class="bi bi-target"></i>
                </div>
                <h3 class="fw-bold text-dark mb-3">Nossa Missão</h3>
                <p class="text-muted mb-4">
                    Conectar profissionais qualificados com clientes que precisam de seus serviços, oferecendo uma experiência 
                    segura, eficiente e satisfatória para ambos os lados.
                </p>
                <div class="mission-features">
                    <span class="feature-badge">Segurança</span>
                    <span class="feature-badge">Eficiência</span>
                    <span class="feature-badge">Qualidade</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-6">
        <div class="col-12">
            <div class="section-header text-center mb-5 animate-on-scroll">
                <h2 class="fw-bold text-dark mb-3">O Que Oferecemos</h2>
                <p class="text-muted">Tudo que você precisa em uma única plataforma</p>
            </div>
            
            <div class="features-grid">
                @php
                    $features = [
                        [
                            'icon' => 'bi-shield-check',
                            'title' => 'Segurança Garantida',
                            'description' => 'Sistemas de verificação e avaliação para garantir confiabilidade total.',
                            'color' => 'primary'
                        ],
                        [
                            'icon' => 'bi-people',
                            'title' => 'Comunidade Ativa',
                            'description' => 'Interações transparentes e construtivas entre profissionais e clientes.',
                            'color' => 'success'
                        ],
                        [
                            'icon' => 'bi-lightning-charge',
                            'title' => 'Agilidade no Processo',
                            'description' => 'Fluxo otimizado para uma experiência rápida e eficiente.',
                            'color' => 'warning'
                        ],
                        [
                            'icon' => 'bi-graph-up',
                            'title' => 'Crescimento Contínuo',
                            'description' => 'Melhorias constantes baseadas no feedback dos usuários.',
                            'color' => 'info'
                        ]
                    ];
                @endphp
                
                @foreach($features as $feature)
                <div class="feature-card animate-on-scroll" data-delay="{{ $loop->index * 100 }}">
                    <div class="feature-icon bg-{{ $feature['color'] }}">
                        <i class="bi {{ $feature['icon'] }}"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">{{ $feature['title'] }}</h4>
                    <p class="text-muted mb-0">{{ $feature['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row mb-6">
        <div class="col-lg-10 mx-auto">
            <div class="objectives-section animate-on-scroll">
                <h3 class="fw-bold text-dark mb-5 text-center">Nossos Objetivos</h3>
                <div class="objectives-timeline">
                    @php
                        $objectives = [
                            ['icon' => 'search', 'title' => 'Facilitar a Busca', 'desc' => 'Encontre serviços específicos de forma rápida e precisa.'],
                            ['icon' => 'star', 'title' => 'Garantir Qualidade', 'desc' => 'Sistemas de avaliação para manter altos padrões.'],
                            ['icon' => 'shield-check', 'title' => 'Proporcionar Segurança', 'desc' => 'Ambiente seguro para todas as interações.'],
                            ['icon' => 'clock', 'title' => 'Economizar Tempo', 'desc' => 'Processo otimizado para resultados rápidos.']
                        ];
                    @endphp
                    
                    @foreach($objectives as $objective)
                    <div class="objective-item animate-on-scroll" data-delay="{{ $loop->index * 150 }}">
                        <div class="objective-icon">
                            <i class="bi bi-{{ $objective['icon'] }}"></i>
                        </div>
                        <div class="objective-content">
                            <h5 class="fw-bold text-dark mb-2">{{ $objective['title'] }}</h5>
                            <p class="text-muted mb-0">{{ $objective['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="stats-card animate-on-scroll">
                <div class="stats-header text-center mb-5">
                    <h3 class="fw-bold text-white mb-3">Por Que Nos Escolher?</h3>
                    <p class="text-white-50">Números que falam por si</p>
                </div>
                
                <div class="stats-grid">
                    <div class="stat-box" data-count="100" data-suffix="%">
                        <div class="stat-circle">
                            <span class="stat-value">90</span>
                            <span class="stat-suffix">%</span>
                        </div>
                        <p class="stat-title">Foco no Usuário</p>
                        <p class="stat-desc">Experiência personalizada</p>
                    </div>
                    
                    <div class="stat-box" data-count="24" data-suffix="/7">
                        <div class="stat-circle">
                            <span class="stat-value">80</span>
                            <span class="stat-suffix">/7</span>
                        </div>
                        <p class="stat-title">Disponibilidade</p>
                        <p class="stat-desc">Acesso 24 horas por dia</p>
                    </div>
                    
                    <div class="stat-box" data-count="1000" data-suffix="+">
                        <div class="stat-circle">
                            <span class="stat-value">200</span>
                            <span class="stat-suffix">+</span>
                        </div>
                        <p class="stat-title">Profissionais</p>
                        <p class="stat-desc">Cadastrados na plataforma</p>
                    </div>
                    
                    <div class="stat-box" data-count="99" data-suffix="%">
                        <div class="stat-circle">
                            <span class="stat-value">95</span>
                            <span class="stat-suffix">%</span>
                        </div>
                        <p class="stat-title">Satisfação</p>
                        <p class="stat-desc">Taxa de aprovação</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3a0ca3;
        --accent-color: #4cc9f0;
        --gradient: linear-gradient(135deg, #4361ee, #3a0ca3);
        --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        --shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.12);
    }
    
    body {
        font-family: 'Poppins', sans-serif;
    }
    
    .mb-6 {
        margin-bottom: 4rem !important;
    }
    
    .floating-shapes {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        pointer-events: none;
        z-index: -1;
    }
    
    .shape {
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), transparent);
        animation: float 6s ease-in-out infinite;
    }
    
    .shape-1 {
        width: 100px;
        height: 100px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
        opacity: 0.1;
    }
    
    .shape-2 {
        width: 150px;
        height: 150px;
        top: 60%;
        right: 10%;
        animation-delay: 2s;
        opacity: 0.05;
    }
    
    .shape-3 {
        width: 80px;
        height: 80px;
        bottom: 20%;
        left: 15%;
        animation-delay: 4s;
        opacity: 0.1;
    }
    
    .gradient-text {
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .progress-line {
        width: 200px;
        height: 4px;
        background: var(--gradient);
        position: relative;
        overflow: hidden;
        margin-top: 1rem;
    }
    
    .progress-line::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: white;
        animation: loading 2s ease-in-out infinite;
    }
    
    @keyframes loading {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    
    .vision-card, .mission-card {
        background: white;
        padding: 2.5rem;
        border-radius: 20px;
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
        margin-bottom: 1rem;
    }
    
    .vision-card:hover, .mission-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
    }
    
    .vision-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    }
    
    .mission-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, #2ecc71, #27ae60);
    }
    
    .card-icon {
        width: 80px;
        height: 80px;
        background: var(--gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        color: white;
        font-size: 2rem;
    }
    
    .mission-card .card-icon {
        background: linear-gradient(135deg, #2ecc71, #27ae60);
    }
    
    .vision-stats {
        display: flex;
        gap: 2rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #eee;
    }
    
    .stat-item {
        text-align: center;
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
        display: block;
    }
    
    .stat-label {
        font-size: 0.9rem;
        color: #666;
    }
    
    .mission-features {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }
    
    .feature-badge {
        background: rgba(46, 204, 113, 0.1);
        color: #27ae60;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin: 0 auto;
        max-width: 1200px;
    }
    
    .feature-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        text-align: center;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover);
    }
    
    .feature-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 1.5rem;
    }
    
    .bg-primary { background-color: #4361ee !important; }
    .bg-success { background-color: #2ecc71 !important; }
    .bg-warning { background-color: #f39c12 !important; }
    .bg-info { background-color: #3498db !important; }
    
    .objectives-section {
        background: white;
        padding: 3rem;
        border-radius: 20px;
        box-shadow: var(--shadow);
        margin-top: 2rem;
    }
    
    .objectives-timeline {
        position: relative;
        padding-left: 2rem;
        margin-top: 2rem;
    }
    
    .objectives-timeline::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(to bottom, var(--primary-color), var(--accent-color));
        border-radius: 3px;
    }
    
    .objective-item {
        display: flex;
        align-items: flex-start;
        gap: 1.5rem;
        margin-bottom: 2.5rem;
        position: relative;
    }
    
    .objective-item:last-child {
        margin-bottom: 0;
    }
    
    .objective-item::before {
        content: '';
        position: absolute;
        left: -2.5rem;
        top: 1.5rem;
        width: 1rem;
        height: 1rem;
        background: var(--primary-color);
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 0 0 3px var(--primary-color);
    }
    
    .objective-icon {
        width: 50px;
        height: 50px;
        background: var(--gradient);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    
    .stats-card {
        background: var(--gradient);
        padding: 4rem 2rem;
        border-radius: 30px;
        position: relative;
        overflow: hidden;
        margin-top: 2rem;
    }
    
    .stats-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        position: relative;
        z-index: 1;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .stat-box {
        text-align: center;
        color: white;
        padding: 1rem;
    }
    
    .stat-circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2.5rem;
        font-weight: 700;
        position: relative;
        border: 3px solid rgba(255, 255, 255, 0.2);
    }
    
    .stat-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }
    
    .stat-desc {
        opacity: 0.9;
        font-size: 0.9rem;
    }
    
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }
    
    .animate-on-scroll.animated {
        opacity: 1;
        transform: translateY(0);
    }
    
    @media (max-width: 768px) {
        .mb-6 {
            margin-bottom: 3rem !important;
        }
        
        .vision-card, .mission-card {
            padding: 1.5rem;
        }
        
        .vision-stats {
            flex-direction: column;
            gap: 1rem;
        }
        
        .features-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
        
        .objectives-timeline {
            padding-left: 1.5rem;
        }
        
        .objective-item::before {
            left: -1.875rem;
        }
        
        .stats-card {
            padding: 3rem 1rem;
        }
        
        .stat-circle {
            width: 100px;
            height: 100px;
            font-size: 2rem;
        }
    }
    
    @media (max-width: 576px) {
        .features-grid {
            gap: 1rem;
        }
        
        .feature-card {
            padding: 1.5rem;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .objectives-section {
            padding: 2rem 1.5rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.animate-on-scroll');
        
        elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const elementVisible = 150;
            const delay = element.dataset.delay || 0;
            
            if (elementTop < window.innerHeight - elementVisible) {
                setTimeout(() => {
                    element.classList.add('animated');
                }, delay);
            }
        });
    };
    
    animateOnScroll();
    
    window.addEventListener('scroll', animateOnScroll);
    
    const counters = document.querySelectorAll('.stat-number, .stat-value');
    
    const startCounter = function(element) {
        const target = parseInt(element.dataset.target || element.textContent);
        const suffix = element.dataset.suffix || '';
        const duration = 4000;
        const increment = target / (duration / 16); 
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target + suffix;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current) + suffix;
            }
        }, 16);
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll('.stat-number, .stat-value');
                counters.forEach(counter => startCounter(counter));
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    document.querySelectorAll('.vision-stats, .stats-grid').forEach(section => {
        observer.observe(section);
    });
    
    window.addEventListener('mousemove', function(e) {
        const shapes = document.querySelectorAll('.shape');
        const mouseX = e.clientX / window.innerWidth;
        const mouseY = e.clientY / window.innerHeight;
        
        shapes.forEach((shape, index) => {
            const speed = 0.05 + (index * 0.02);
            const x = (mouseX - 0.5) * 100 * speed;
            const y = (mouseY - 0.5) * 100 * speed;
            
            shape.style.transform = `translate(${x}px, ${y}px)`;
        });
    });
    
    const cards = document.querySelectorAll('.vision-card, .mission-card, .feature-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    function equalizeCardHeights() {
        if (window.innerWidth >= 992) { 
            const visionCard = document.querySelector('.vision-card');
            const missionCard = document.querySelector('.mission-card');
            
            if (visionCard && missionCard) {
                const maxHeight = Math.max(
                    visionCard.offsetHeight,
                    missionCard.offsetHeight
                );
                
                visionCard.style.minHeight = maxHeight + 'px';
                missionCard.style.minHeight = maxHeight + 'px';
            }
        }
    }
    
    window.addEventListener('load', equalizeCardHeights);
    window.addEventListener('resize', equalizeCardHeights);
});
</script>
@endsection