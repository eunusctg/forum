export default {
  content: ['./resources/**/*.blade.php', './app/Livewire/**/*.php'],
  darkMode: 'class',
  theme: {
    extend: {
      boxShadow: { liquid: '0 8px 32px rgba(56, 189, 248, 0.25)' },
      backdropBlur: { glass: '24px' },
    },
  },
  plugins: [],
};
