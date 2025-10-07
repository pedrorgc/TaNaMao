<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">
        <i class="bi bi-pencil-square me-1"></i> Editar Informações Pessoais
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editProfileForm">
        <div class="mb-3">
            <label for="editNome" class="form-label">Nome Completo</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" class="form-control" id="editNome" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="editEmail" class="form-label">E-mail</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" class="form-control" id="editEmail" required>
            </div>
        </div>
                        <div class="mb-3">
        <label for="editTelefone" class="form-label">Telefone</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
            <input type="tel" class="form-control" id="editTelefone" required pattern="\([0-9]{2}\) [0-9]{5}-[0-9]{4}">
        </div>
                        </div>
                        <div class="mb-3">
        <label for="editLocalizacao" class="form-label">Localização</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
            <input type="text" class="form-control" id="editLocalizacao" required>
        </div>
                        </div>
                        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="saveProfileBtn">Salvar Alterações</button>
                </div>
            </div>
        </div>
    </div>