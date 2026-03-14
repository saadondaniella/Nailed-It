<link rel="stylesheet" href="{{ asset('css/confirm-modal.css') }}">

<div id="confirm-modal" class="confirm-modal" aria-hidden="true">
    <div class="confirm-modal__backdrop"></div>

    <div class="confirm-modal__panel" role="dialog" aria-modal="true" aria-labelledby="confirm-modal-title">
        <h3 id="confirm-modal-title">Confirm deletion</h3>
        <p>Are you sure you want to delete this product?</p>

        <div class="confirm-modal__actions">
            <button type="button" id="confirm-cancel" class="confirm-modal__button confirm-modal__button--secondary">
                Cancel
            </button>

            <button type="button" id="confirm-delete" class="confirm-modal__button confirm-modal__button--danger">
                Delete
            </button>
        </div>
    </div>
</div>

<script src="{{ asset('js/confirm-modal.js') }}" defer></script>