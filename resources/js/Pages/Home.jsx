import React from 'react';

export default function Home({ laravelVersion, phpVersion }) {
  return (
    <div style={{ padding: '2rem', fontFamily: 'sans-serif' }}>
      <h1>Bem-vindo ao Marketplace!</h1>
      <p>Versão Laravel: {laravelVersion}</p>
      <p>Versão PHP: {phpVersion}</p>
    </div>
  );
}
