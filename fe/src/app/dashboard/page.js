"use client";

import { useEffect, useState } from 'react';
import Cookie from 'js-cookie';
import axios from 'axios';
import { useRouter } from 'next/navigation';

export default function Dashboard() {
  const [user, setUser] = useState(null);
  const [error, setError] = useState('');
  const router = useRouter();

  useEffect(() => {
    const token = Cookie.get('token');
    if (!token) {
      router.push('/login');
    } else {

      axios.get('http://127.0.0.1:8000/api/v1/auth/user', {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
        .then(response => {
          setUser(response.data);
        })
        .catch(err => {
          setError('Kullanıcı bilgileri alınamadı');
        });
    }
  }, [router]);

  if (error) return <div>{error}</div>;

  return (
    <div>
      <h1>Dashboard</h1>
      {user ? (
        <div>
          <h2>Hoş geldiniz, {user.name}</h2>
          <p>Email: {user.email}</p>
        </div>
      ) : (
        <div>Yükleniyor...</div>
      )}
    </div>
  );
}
