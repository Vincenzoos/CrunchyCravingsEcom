<div id="shop-box" class="mb-4 p-3">
    <div class="order-lookup form mx-auto" style="max-width: 500px;">
        <?= $this->Form->create(null, ['url' => ['action' => 'orders']]) ?>
        <fieldset>
            <?= $this->Form->control('tracking_number', [
                'label' => ['text' => '<h4 class="text-center" style="margin-top: 1rem;">Tracking Number</h4>', 'escape' => false],
                'required' => true,
                'class' => 'form-control',
                'maxlength' => TRACKING_NUMBER_MAX_LENGTH,
                'placeholder' => 'Enter your tracking number',
            ]) ?>
        </fieldset>
        <div class="text-center mt-3">
            <?= $this->Form->button(__('Lookup Order'), ['class' => 'btn btn-primary']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>