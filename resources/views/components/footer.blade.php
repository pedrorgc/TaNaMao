<footer class="bg-primary text-white pt-5 pb-3">
    <div class="container">
        <div class="row">
            <!-- Logo e descrição -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold"> 
                    <img src="{{ asset('assets/logo_TaNaMao.png') }}" alt="TaNaMão" style="height: 50px;">
                </h5>
                <p class="small">
                    Encontre os melhores serviços locais de forma rápida, prática e confiável.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white fs-5"><i class="bi bi-whatsapp"></i></a>
                    <a href="#" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white fs-5"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <!-- Acesse -->
            <div class="col-md-3 mb-4">
                <h6 class="fw-bold">Acesse</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none">Como funciona</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Quem Somos</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Avaliações</a></li>
                </ul>
            </div>

            <!-- Legal -->
            <div class="col-md-3 mb-4">
                <h6 class="fw-bold">Legal</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none">Termos de Serviço</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Política de Privacidade</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Cookies</a></li>
                </ul>
            </div>

            <!-- Contato -->
            <div class="col-md-3 mb-4">
                <h6 class="fw-bold">Contato</h6>
                <ul class="list-unstyled small">
                    <li><i class="bi bi-envelope me-2"></i> contato@tanamao.com.br</li>
                    <li><i class="bi bi-telephone me-2"></i> (33) 99123-4567</li>
                    <li><i class="bi bi-geo-alt me-2"></i> Almenara, MG - Brasil</li>
                </ul>
            </div>
        </div>

        <hr class="border-light">

        <!-- Copyright -->
        <div class="text-center small">
            Copyright © {{ date('Y') }}, TaNaMão. Todos os direitos reservados.
        </div>
    </div>
</footer>
