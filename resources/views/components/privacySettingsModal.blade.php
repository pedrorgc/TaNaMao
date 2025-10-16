<div class="modal fade" id="privacySettingsModal" tabindex="-1" aria-labelledby="privacySettingsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold text-primary" id="privacySettingsModalLabel">
          <i class="bi bi-shield-lock me-2"></i> Configurações de Privacidade
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form id="privacySettingsForm">
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="showProfilePublic" checked>
            <label class="form-check-label" for="showProfilePublic">
              Tornar meu perfil público (visível para todos)
            </label>
          </div>

          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="showPhone">
            <label class="form-check-label" for="showPhone">
              Mostrar meu número de telefone no perfil
            </label>
          </div>

          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="showEmail">
            <label class="form-check-label" for="showEmail">
              Mostrar meu e-mail de contato
            </label>
          </div>

          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="allowMessages" checked>
            <label class="form-check-label" for="allowMessages">
              Permitir que outros usuários me enviem mensagens
            </label>
          </div>

          <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="showPortfolio" checked>
            <label class="form-check-label" for="showPortfolio">
              Mostrar meu portfólio publicamente
            </label>
          </div>

          <div class="alert alert-info small">
            <i class="bi bi-info-circle me-2"></i>
            Você pode alterar essas configurações a qualquer momento. Mudanças serão aplicadas imediatamente.
          </div>
        </form>
      </div>

      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" form="privacySettingsForm" class="btn btn-primary rounded-pill px-4">
          Salvar Alterações
        </button>
      </div>
    </div>
  </div>
</div>
