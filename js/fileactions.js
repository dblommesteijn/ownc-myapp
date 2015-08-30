


(function() {

    if (!OCA.MyApp) {
        OCA.MyApp = {};
    }

    OCA.MyApp.Publish = {
        attach: function(fileList) {
            var fileActions = fileList.fileActions;
            fileActions.registerAction({
                name: "Publish",
                displayName: t('files', 'Publish'),
                mime: 'all',
                permissions: OC.PERMISSION_READ,
                icon: function () {
                    return OC.imagePath('myapp', 'actions/cloud_upload');
                },
                actionHandler: function (filename, context) {
                    var url = OC.generateUrl('/apps/myapp/publish');
                    var data = { id: context.$file.data('id') };
                    // request publish of the selected file/ dir
                    $.post(url, data).success(function (response) {
                        console.log(response);
                        // TODO: handle request here!
                    });



                    // var downloadFileaction = $(context.$file).find('.fileactions .action-download');

                    // // don't allow a second click on the download action
                    // if(downloadFileaction.hasClass('disabled')) {
                    //  return;
                    // }

                    // if (url) {
                    //  var disableLoadingState = function() {
                    //      context.fileList.showFileBusyState(filename, false);
                    //  };

                    //  context.fileList.showFileBusyState(downloadFileaction, true);
                    //  OCA.Files.Files.handleDownload(url, disableLoadingState);
                    // }
                }
            });
        }
    };

})();

OC.Plugins.register('OCA.Files.FileList', OCA.MyApp.Publish);
