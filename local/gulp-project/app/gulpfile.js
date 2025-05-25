const gulp = require('gulp');
const {series} = require('gulp');
const sourcemaps = require('gulp-sourcemaps');
const babel = require('gulp-babel');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const less = require('gulp-less');
const autoprefixer = require('gulp-autoprefixer');
const cleancss = require('gulp-clean-css');
const svgSprite = require('gulp-svg-sprite');
imagemin = require('gulp-imagemin');
const rimraf = require('gulp-rimraf');
var path = require('path');

const templatePath = '../../templates/pansion2023/static/';
const destPath = '../dist/';

function scripts() {
    return gulp.src(
        [ // Берём файлы из источников
            // 'node_modules/jquery/dist/jquery.min.js', // Пример подключения библиотеки
            // 'js/require.js', // Пример подключения библиотеки
            'js/jquery-3.2.1.min.js', // Пример подключения библиотеки
            'vendor/**/*.js', // Пример подключения библиотеки
            'js/modules/*.js', // Пользовательские скрипты, использующие библиотеку, должны быть подключены в конце
            'js/basic/*.js', // Пользовательские скрипты, использующие библиотеку, должны быть подключены в конце
            'js/app.js', // Пользовательские скрипты, использующие библиотеку, должны быть подключены в конце
            'js/components/**/*.js', // Пользовательские скрипты, использующие библиотеку, должны быть подключены в конце
            'js/template/**/*.js', // Пользовательские скрипты, использующие библиотеку, должны быть подключены в конце
            'js/forms/**/*.js', // Пользовательские скрипты, использующие библиотеку, должны быть подключены в конце
            'js/pages/**/*.js', // Пользовательские скрипты, использующие библиотеку, должны быть подключены в конце
        ], {sourcemaps: true})
        .pipe(sourcemaps.init())
        .pipe(babel(
            {
                presets: ['@babel/env']
            }
        ))
        .pipe(uglify())
        .pipe(concat('main.min.js'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(destPath + 'js/'))
        .pipe(gulp.dest(templatePath));
}

function styles() {
    return gulp.src(
        [
            'fonts/*.css',
            'less/normalize.css',
            'less/*.less',
            'less/*/*.less',
        ]) // Выбираем источник: "app/sass/main.sass" или "app/less/main.less"
        .pipe(concat('app.min.less'))
        .pipe(less())
        .pipe(concat('app.min.css')) // Конкатенируем в файл app.min.js
        .pipe(autoprefixer({
            overrideBrowserslist: ['last 10 versions'],
            grid: true
        })) // Создадим префиксы с помощью Autoprefixer
        .pipe(cleancss({level: {1: {specialComments: 0}}/* , format: 'beautify' */})) // Минифицируем стили
        .pipe(gulp.dest(destPath + 'css/')) // Выгрузим результат в папку "app/css/"
        .pipe(gulp.dest(templatePath));
}

config = {
    shape: {
        id: {
            // generator: "icon-%s"
            generator: function (name) {
                return 'icon-' + path.basename( name.replace(/\s+/g, this.whitespace),'.svg');
            }
        },
        dimension: { // Set maximum dimensions
            maxWidth: 32,
            maxHeight: 32
        },
        spacing: { // Add padding
            padding: 0
        },
        // dest: 'out/intermediate-svg' // Keep the intermediate files
    },
    mode: {
        symbol: {
            sprite: "../sprite/sprite.svg",  //sprite file name
        }
    }
};

function svgSprites() {
    return gulp.src('sprite/**/*.svg')
        .pipe(svgSprite(config))
        .pipe(gulp.dest(destPath));
}

function svgSpritesCopy() {
    return gulp.src(destPath + 'sprite/sprite.svg')
        .pipe(gulp.dest(templatePath));
}


function fontcopy() {
    return gulp.src([ // Выбираем нужные файлы
        'fonts/*.eot',
        'fonts/*.svg',
        'fonts/*.ttf',
        'fonts/*.woff',
        'fonts/*.woff2',
    ]) // Параметр "base" сохраняет структуру проекта при копировании
        .pipe(gulp.dest(destPath + 'fonts/')) // Выгружаем в папку с финальной сборкой
        .pipe(gulp.dest(templatePath + 'fonts/')) // Выгружаем в папку с финальной сборкой
}

function vendorcopy() {
    return gulp.src([ // Выбираем нужные файлы
        'vendor/**/*',
    ]) // Параметр "base" сохраняет структуру проекта при копировании
        .pipe(gulp.dest(destPath + 'vendor/')) // Выгружаем в папку с финальной сборкой
        .pipe(gulp.dest(templatePath + 'vendor/')) // Выгружаем в папку с финальной сборкой
}

function cleandist() {
    return gulp.src(destPath, {read: false}).pipe(rimraf({force: true})) // Удаляем всё содержимое папки "dist/"
}

function images() {
    return gulp.src('img/**/*')
        .pipe(
            imagemin([
                imagemin.gifsicle({interlaced: true}),
                imagemin.mozjpeg({quality: 85, progressive: true}),
                imagemin.optipng({optimizationLevel: 6}),
                imagemin.svgo({
                    plugins: [
                        {
                            name: 'removeViewBox',
                            active: true
                        },
                        {
                            name: 'cleanupIDs',
                            active: false
                        }
                    ]
                })
            ])
        )
        .pipe(gulp.dest(destPath + 'img'))
        .pipe(gulp.dest(templatePath + 'img'))
}

exports.scripts = scripts;
exports.scripts = styles;
exports.svgSprites = svgSprites;
exports.fontcopy = fontcopy;
exports.cleandist = cleandist;
exports.vendorcopy = vendorcopy;

// exports.default = series(scripts,styles,svgSprites);

exports.static = series(fontcopy, vendorcopy, images)
exports.default = series(styles, scripts, svgSprites, svgSpritesCopy);
exports.build = series(exports.static, exports.default);


// imagemin 8+
// const { dest, series, src } = require('gulp');
// let imagemin;
//
// const images = series(
//     async () => {
//         imagemin = await import('gulp-imagemin');
//     },
//     () => src('./src/images/**/*')
//         .pipe(
//             imagemin.default(
//                 [
//                     imagemin.mozjpeg({ quality: 60, progressive: true }),
//                     imagemin.optipng({ optimizationLevel: 5, interlaced: null })
//                 ],
//                 {
//                     silent: true
//                 }
//             )
//         )
//         .pipe(dest('./dist/images'))
// );