## Api end points ( Deploy on Vercel )

### Auth ( Login)

[Register => ( https://node-blog-dun.vercel.app/auth/sign-up )](https://node-blog-dun.vercel.app/auth/sign-up)  
Method: Post  
Field ( body ): name , password  
( Login again after registration )

[Login => ( https://node-blog-dun.vercel.app/auth/login )](https://node-blog-dun.vercel.app/auth/login)  
Method: Post  
Field ( body ): name , password

[Logout => ( https://node-blog-dun.vercel.app/auth/logout )](https://node-blog-dun.vercel.app/auth/logout)  
Method: Post  
( remove refresh-token from cookie )

---

### User Info

[Get all Users => ( https://node-blog-dun.vercel.app/users )](https://node-blog-dun.vercel.app/users)  
Method: Get  
Field ( header ): Authorization ( AccessToken that you got when you log in )

[Get User By Id => ( https://node-blog-dun.vercel.app/users/:id )](https://node-blog-dun.vercel.app/users)  
Method: Get  
Field ( header ): Authorization ( AccessToken that you got when you log in )

[Update User => ( https://node-blog-dun.vercel.app/users )](https://node-blog-dun.vercel.app/users)  
Method: Put  
Field ( body ): id , name ( or ) role  
Field ( header ): Authorization ( AccessToken that you got when you log in )

[Delete User => ( https://node-blog-dun.vercel.app/users )](https://node-blog-dun.vercel.app/users)  
Method: Delete  
Field ( body ): id  
Field ( header ): Authorization ( AccessToken that you got when you log in )

[Update User Password => ( https://node-blog-dun.vercel.app/users/change-pw )](https://node-blog-dun.vercel.app/users/change-pw)  
Method: Post  
Field ( body ): id , password  
Field ( header ): Authorization ( AccessToken that you got when you log in )

---

### Data

[Get all Data => ( https://node-blog-dun.vercel.app/ )](https://node-blog-dun.vercel.app/)  
Method: Get  
Field ( header ): Authorization ( AccessToken that you got when you log in )

[Post Data => ( https://node-blog-dun.vercel.app/ )](https://node-blog-dun.vercel.app/)  
Method: Post  
Field ( body ): title , body  
Field ( header ): Authorization ( AccessToken that you got when you log in )

[Update Data => ( https://node-blog-dun.vercel.app/ )](https://node-blog-dun.vercel.app/)  
Method: Put  
Field ( body ): id , title ( or ) body  
Field ( header ): Authorization ( AccessToken that you got when you log in )

[Delete Data => ( https://node-blog-dun.vercel.app/ )](https://node-blog-dun.vercel.app/)  
Method: Delete  
Field ( body ): id  
Field ( header ): Authorization ( AccessToken that you got when you log in )
