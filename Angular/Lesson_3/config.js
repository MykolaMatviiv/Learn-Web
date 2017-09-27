System.config({
    transpiler: 'ts',

    typescriptOptions: {
        enitDecoratorMetadata: true,
        experimentalDecorators: true
    },

    paths: {
        'npm:': './node_modules'
    },

    map: {
        'app': './src',

        '@angular/core':'npm:@angular/core/bundles/core.und.js',
        '@angular/common':'npm:@angular/common/bundles/common.und.js',
        '@angular/compiler':'npm:@angular/compiler/bundles/compiler.und.js',
        '@angular/platform-browser':'npm:@angular/platform-browser/bundles/platform-browser.und.js',
        '@angular/platform-browser-dynamic':'npm:@angular/platform-browser-dynamic/bundles/platform-browser-dynamic.und.js',

        'rxjs': 'npm:rxjs',
        'typescript': 'npm:typescript',
        'ts': 'npm:plugin-typescript/lib/plugin.js'
    },

    packages: {
        app: {
            main: {
                main: './main.ts',
                defaultExtension: 'ts'
            },
            rxjs: {
                defaultExtension: 'js'
            },
            typescript: {
                main: 'lib/typescript.js',
                meta: {
                    'lib/typescript.js': {
                        exports: 'ts'
                    }
                }
            }
        }
    }
});