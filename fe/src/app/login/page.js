"use client";

import { useState } from 'react';
import axios from 'axios';
import Cookie from 'js-cookie';
import { useRouter } from 'next/navigation';

export default function Login() {
  const [email, setEmail] = useState('umut@gmail.com');
  const [password, setPassword] = useState('14533541');
  const [error, setError] = useState('');
  const router = useRouter();

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.post('http://127.0.0.1:8000/api/v1/auth/login', {
        email,
        password,
      }, { withCredentials: true });

      Cookie.set('token', response.data.token, { expires: 7 }); // 7 gün 

      router.push('/dashboard');
    } catch (error) {
      setError('Giriş başarısız, lütfen tekrar deneyin');
    }
  };

  return (
    <div>
      <h1 className='text-xl text-center mb-10'>Login</h1>
      <form className='flex flex-col gap-5 max-w-72 mx-auto' onSubmit={handleSubmit}>
        <input
          type="email"
          placeholder="E-posta"
          value={email}
          onChange={(e) => setEmail(e.target.value)}
          required
          className='text-black'
        />
        <input
          type="password"
          placeholder="Şifre"
          value={password}
          onChange={(e) => setPassword(e.target.value)}
          required
          className='text-black'
        />
        {error && <div>{error}</div>}
        <button type="submit" >Giriş Yap</button>
      </form>
    </div>
  );
}
