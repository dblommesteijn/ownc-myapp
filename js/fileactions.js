


(function() {
	if (!OCA.MyApp) {
		OCA.MyApp = {};
	}

	OCA.MyApp.Publish = {
		attach: function(fileList) {
			var fileActions = fileList.fileActions;
			fileActions.registerAction({
				name: "Test",
				displayName: t('files', 'Test'),
				mime: 'all',
				permissions: OC.PERMISSION_READ,
				icon: function () {
					return OC.imagePath('core', 'actions/download');
				},
				actionHandler: function (filename, context) {
					var dir = context.dir || context.fileList.getCurrentDirectory();
					var url = context.fileList.getDownloadUrl(filename, dir);

					var downloadFileaction = $(context.$file).find('.fileactions .action-download');

					// don't allow a second click on the download action
					if(downloadFileaction.hasClass('disabled')) {
						return;
					}

					if (url) {
						var disableLoadingState = function() {
							context.fileList.showFileBusyState(filename, false);
						};

						context.fileList.showFileBusyState(downloadFileaction, true);
						OCA.Files.Files.handleDownload(url, disableLoadingState);
					}
				}
			});
		}
	};

})();

OC.Plugins.register('OCA.Files.FileList', OCA.MyApp.Publish);
