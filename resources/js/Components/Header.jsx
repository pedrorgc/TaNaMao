import { useState } from 'react';
import NavLink from './NavLink';
import logo from '../../imagens/logo_TaNaMao.png';

export default function Header({ auth }) {
  const [menuOpen, setMenuOpen] = useState(false);

  const safeRoute = (name) => (typeof route !== 'undefined' ? route(name) : '#');
  const safeCurrent = (name) => typeof route !== 'undefined' && route().current(name);

  return (
    <header className="fixed top-0 left-0 right-0 z-50 bg-[#1D4ED8] text-white shadow-md">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          {/* Logo */}
          <a href="#topo" className="flex items-center space-x-3">
            <img src={logo} alt="TaNaMão" className="h-10 w-auto" />
          </a>

          {/* Desktop */}
          <nav className="hidden md:flex items-center space-x-6">
            <a href="#como-funciona" className="text-white hover:text-black transition-colors">Como Funciona</a>
            <a href="#sobre" className="text-white hover:text-black transition-colors">Sobre</a>

            {auth && auth.user ? (
              <NavLink href={safeRoute('dashboard')} active={safeCurrent('dashboard')} className="flex items-center">
                {/* simple inline SVG user */}
                <svg className="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none">
                  <path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zM4 20c0-2.667 3.333-4 8-4s8 1.333 8 4v1H4v-1z" fill="currentColor"/>
                </svg>
                {auth.user.name}
              </NavLink>
            ) : (
              <NavLink href={safeRoute('login')} className="flex items-center">
                <svg className="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none">
                  <path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zM4 20c0-2.667 3.333-4 8-4s8 1.333 8 4v1H4v-1z" fill="currentColor"/>
                </svg>
                Entrar
              </NavLink>
            )}
          </nav>

          {/* Mobile hamburger */}
          <div className="md:hidden">
            <button
              onClick={() => setMenuOpen(s => !s)}
              aria-expanded={menuOpen}
              aria-label={menuOpen ? 'Fechar menu' : 'Abrir menu'}
              className="p-2 rounded-md hover:bg-blue-700 focus:outline-none"
            >
              {menuOpen ? (
                <svg className="h-6 w-6" viewBox="0 0 24 24" fill="none">
                  <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
                </svg>
              ) : (
                <svg className="h-6 w-6" viewBox="0 0 24 24" fill="none">
                  <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
                </svg>
              )}
            </button>
          </div>
        </div>
      </div>

      {/* Mobile menu (coloca fora do fluxo do header, abaixo) */}
      <div className={`${menuOpen ? 'block' : 'hidden'} md:hidden bg-[#1D4ED8] px-4 pb-4`}>
        <a href="#como-funciona" className="block text-white py-2 hover:text-black" onClick={() => setMenuOpen(false)}>Como Funciona</a>
        <a href="#sobre" className="block text-white py-2 hover:text-black" onClick={() => setMenuOpen(false)}>Sobre</a>
        <a href={safeRoute('login')} className="block text-white py-2 hover:text-black" onClick={() => setMenuOpen(false)}>Entrar</a>
      </div>
    </header>
  );
}
