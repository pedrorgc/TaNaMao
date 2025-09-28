import Header from '../Components/Header';

export default function Welcome({ auth }) {
  return (
    <>
      {/* Header FIXO deve vir primeiro (ou no topo da árvore) */}
      <Header auth={auth} />

      {/* Conteúdo: adicionamos padding-top igual à altura do header (h-16 -> pt-16) */}
      <main className="pt-16 min-h-screen bg-gray-100">
        <section id="hero" className="py-16 text-center">
          <h1 className="text-4xl font-bold text-gray-800">Bem-vindo ao TaNaMão</h1>
          <p className="mt-4 text-gray-600">Landing page com âncoras e header responsivo.</p>
        </section>

        <section id="como-funciona" className="py-20 bg-white">
          <div className="max-w-4xl mx-auto px-4">
            <h2 className="text-2xl font-semibold text-center">Como Funciona</h2>
            <p className="mt-4 text-center text-gray-600">Conteúdo da seção "Como Funciona"...</p>
          </div>
        </section>

        <section id="sobre" className="py-20 bg-gray-50">
          <div className="max-w-4xl mx-auto px-4">
            <h2 className="text-2xl font-semibold text-center">Sobre Nós</h2>
            <p className="mt-4 text-center text-gray-600">Conteúdo da seção "Sobre"...</p>
          </div>
        </section>
      </main>
    </>
  );
}
