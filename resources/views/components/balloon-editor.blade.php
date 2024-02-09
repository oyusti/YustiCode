<div class=" border-b" wire:ignore x-data="{
    message: @entangle($attributes->wire('model')),
    {{-- isfocus: false, --}}
}" x-init="
    $watch('message', value => {
        if(!value){
            balloonEditor.setData('');
        }
    });
    BalloonEditor
        .create($refs.MyEditor)
        .then( editor => {

            balloonEditor = editor;
            
            editor.model.document.on('change:data', () => {
                message = editor.getData();
            });

            {{-- editor.editing.view.document.on('change:isfocused', (evt, data, isfocused) => {
                console.log(isfocused);
            }); --}}
        }) 
        .catch( error => {
            console.error( error );
        });">
    <div x-ref="MyEditor"></div>
</div>