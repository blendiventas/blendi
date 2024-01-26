let colors = {
    transparent: "transparent",
    black: "#000000",
    white: "#ffffff",
    gray: {
        /* '50':  '#f9fafb', */
        '25':  '#F8F8FA',
        '50':  '#F7F7F7',
        '70': '#F8F9FA',
        /* '100': '#f4f5f7', */
        '100': '#D4D4D4',
        '200': '#e5e7eb',
        '250': '#E0E0E0',
        '300': '#d2d6dc',
        '400': '#9fa6b2',
        '450': '#686868',
        '500': '#6b7280',
        '600': '#4b5563',
        '650': '#4F4F4F',
        '700': '#374151',
        '800': '#252f3f',
        '900': '#161e2e',
    },
    coral: {
        '50':  '#fdf2f2',
        '100': '#fde8e8',
        '200': '#fbd5d5',
        '300': '#f8b4b4',
        '400': '#f98080',
        '500': '#f05252',
        '600': '#e02424',
        '700': '#c81e1e',
        '800': '#9b1c1c',
        '900': '#771d1d',
    },
    pumpkin: {
        '50':  '#fff8f1',
        '100': '#feecdc',
        '200': '#fcd9bd',
        '300': '#fdba8c',
        '400': '#ff8a4c',
        '500': '#ff5a1f',
        '600': '#d03801',
        '700': '#b43403',
        '800': '#8a2c0d',
        '900': '#73230d',
    },
    orange: {
        '50':  '#fdfdea',
        '100': '#fdf6b2',
        '200': '#fce96a',
        '300': '#faca15',
        '400': '#e3a008',
        '500': '#c27803',
        '600': '#9f580a',
        '700': '#8e4b10',
        '800': '#723b13',
        '900': '#633112',
    },
    turquoise: {
        '50':  '#f3faf7',
        '100': '#def7ec',
        '200': '#bcf0da',
        '300': '#84e1bc',
        '400': '#31c48d',
        '500': '#0e9f6e',
        '600': '#057a55',
        '700': '#046c4e',
        '800': '#03543f',
        '900': '#014737',
    },
    beach: {
        '50':  '#edfafa',
        '100': '#d5f5f6',
        '200': '#afecef',
        '300': '#7edce2',
        '400': '#16bdca',
        '500': '#0694a2',
        '600': '#047481',
        '700': '#036672',
        '800': '#05505c',
        '900': '#014451',
    },
    azure: {
        '50':  '#ebf5ff',
        '100': '#e1effe',
        '200': '#c3ddfd',
        '300': '#a4cafe',
        '400': '#76a9fa',
        '500': '#3f83f8',
        '600': '#1c64f2',
        '700': '#1a56db',
        '800': '#1e429f',
        '900': '#233876',
    },
    blue: {
        '50':  '#E8F2F3FF',
        '100': '#ADF5E7',
        '200': '#0C9AAC',
        '300': '#3c8388',
        '400': '#24838a',
        '500': '#219653',
        '600': '#156772',
        '700': '#106773',
        '800': '#076572',
        '900': '#005f6c',
    },
    indigo: {
        '50':  '#f6f5ff',
        '100': '#edebfe',
        '200': '#dcd7fe',
        '300': '#cabffd',
        '400': '#ac94fa',
        '500': '#9061f9',
        '600': '#7e3af2',
        '700': '#6c2bd9',
        '800': '#5521b5',
        '900': '#4a1d96',
    },
    cerise: {
        '50':  '#fdf2f8',
        '100': '#fce8f3',
        /* '200': '#fad1e8', */
        '200': '#FBC9C3',
        '300': '#f8b4d9',
        '400': '#f17eb8',
        /* '500': '#e74694', */
        '500': '#EB5757',
        '600': '#d61f69',
        '700': '#bf125d',
        '800': '#99154b',
        '900': '#751a3d',
    },
    blendi: {
        '35':  '#DFF0F3',
        '50':  '#E8F2F3FF',
        /* '100': '#DFF0F3', */
        '100': '#ADF5E7',
        '200': '#0C9AAC',
        '300': '#3c8388',
        '400': '#24838a',
        /* '500': '#24838AFF', */
        '500': '#219653',
        '600': '#156772',
        '700': '#106773',
        '800': '#076572',
        '900': '#005f6c',
    },
    blendimodal: {
        'background': '#F8F9FA',
        'background_orange': '#F8D2B1',
        'background_green': '#B9DD9C',
        'background_blue': '#E1F3FF',
        'letra_blue': '#2980B9',
    },
    blendigray: {
        '50': '#D6D6D6',
        '100': '#484848',
    },
    blendigreen: {
        '500': '#ACD988',
        '900': '#219653',
    },
    blendirecibido: {
        '200': '#FFE3CB',
        '500': '#FBCCA2',
        '900': '#F2994A',
    },

};

tailwind.config = {
    darkMode: 'class',
    theme: {
        colors: colors,
        fontFamily: {
            sans: ['Graphik', 'sans-serif'],
            serif: ['Merriweather', 'serif'],
        },
        extend: {
            spacing: {
                '8xl': '96rem',
                '9xl': '128rem',
            },
            borderRadius: {
                '4xl': '2rem',
            }
        }
    }
}