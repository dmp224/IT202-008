<table><tr><td> <em>Assignment: </em> IT202 Milestone 2 Shop Project</td></tr>
<tr><td> <em>Student: </em> Dileesha Patel (dmp224)</td></tr>
<tr><td> <em>Generated: </em> 5/8/2023 10:55:11 PM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-008-S23/it202-milestone-2-shop-project/grade/dmp224" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Checkout Milestone2 branch</li><li>Create a new markdown file called milestone2.md</li><li>git add/commit/push immediate</li><li>Fill in the below deliverables</li><li>At the end copy the markdown and paste it into milestone2.md</li><li>Add/commit/push the changes to Milestone2</li><li>PR Milestone2 to dev and verify</li><li>PR dev to prod and verify</li><li>Checkout dev locally and pull changes to get ready for Milestone 3</li><li>Submit the direct link to this new milestone2.md file from your GitHub prod branch to Canvas</li></ol><p>Note: Ensure all images appear properly on github and everywhere else. Images are only accepted from dev or prod, not local host. All website links must be from prod (you can assume/infer this by getting your dev URL and changing dev to prod).</p></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> Users with admin or shop owner will be able to add products </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707834-bf5a5b13-ec36-4597-9741-aa830c195be2.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshot of admin create item page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236698352-b1f2fc96-3db6-4018-aa49-c3a9aeb24d4a.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Adding Product<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add screenshot of populated Products table clearly showing the columns</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236698416-ad96814b-87b5-4594-9266-8fcdbcc9dab5.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Product Table<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Briefly describe the code flow for creating a Product</td></tr>
<tr><td> <em>Response:</em> <div>- The user clicks the product dropdown and clicks create product</div><div>- The user<br>fills in the product details and submits</div><div>- The product data is verified</div><div>- The<br>product is created in the database</div><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/dmp224/IT202-008/pull/46">https://github.com/dmp224/IT202-008/pull/46</a> </td></tr>
<tr><td> <em>Sub-Task 5: </em> Add a direct link to heroku prod for this file</td></tr>
<tr><td>Not provided</td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Any user can see visible products on the Shop Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707834-bf5a5b13-ec36-4597-9741-aa830c195be2.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot of the Shop page showing 10 items without filters/sorting applied</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236698490-016c271f-862e-4a33-8736-73a51bf79ce3.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Heroku dev url that shows 10 sample items in 2 pages<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot of the Shop page showing both filters and a different sorting applied (should be more than 1 sample product)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236698535-41be8001-b1a4-4b6b-91f3-8219f8554d48.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Filter and sort to the shop page<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a screenshot of the filter/sort logic from the code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236698561-051c4bc1-bcf9-4b4d-bb0b-953b2e5259bb.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Code snippet with UCID and date<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 4: </em> Briefly explain how the results are shown and how the filters are applied</td></tr>
<tr><td> <em>Response:</em> <div>- A user fills in the filter form and submits.</div><div>- The base query<br>is created</div><div>- Parameters and where additions are added based on the information submitted<br>in the form</div><div>- Sort and Order by is added based on the user<br>selection or on default, created is used to Order by.</div><br></td></tr>
<tr><td> <em>Sub-Task 5: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/dmp224/IT202-008/pull/46">https://github.com/dmp224/IT202-008/pull/46</a> </td></tr>
<tr><td> <em>Sub-Task 6: </em> Add a direct link to heroku prod for this file</td></tr>
<tr><td>Not provided</td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> Show Admin/Shop Owner Product List (this is not the Shop page and should show visibility status) </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707834-bf5a5b13-ec36-4597-9741-aa830c195be2.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshot of the Admin List page/results</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236940193-d228801b-00fd-49ac-87b2-be3dc1f7bbf0.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Admin page showing visible and non-visible products<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Briefly explain how the results are shown</td></tr>
<tr><td> <em>Response:</em> <div>- The user role is checked at the beginning to ensure only authorised<br>people see the required information</div><div>- Using a foreach loop, the queried products are<br>displayed as a card on the page</div><div>- To filter the products a user<br>fills in the filter form and submits.</div><div>- The base query is created</div><div>- Parameters<br>and where additions are added based on the information submitted in the form</div><div>-<br>Sort and Order by is added based on the user selection or on<br>default, created is used to Order by.</div><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/dmp224/IT202-008/pull/46">https://github.com/dmp224/IT202-008/pull/46</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a direct link to heroku prod for this file</td></tr>
<tr><td>Not provided</td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> Admin/Shop Owner Edit button </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707834-bf5a5b13-ec36-4597-9741-aa830c195be2.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot showing the edit button visible to the Admin on the Shop page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236933311-bf731107-2d7b-44ad-9dfa-880bca37e8ff.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Edit button for show owner<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236939082-3e8e5d69-ee39-41f5-8bb2-3a53fa3158c0.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Not an admin page but public shop page<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot showing the edit button visible to the Admin on the Product Details Page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236934316-f0e6ef1e-d0f4-48dd-85a1-31c86bbd051a.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Edit button visible to admin on product details page<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236939231-db2d5fa5-569a-4e1c-9882-d102d12e4bca.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Product view page not an admin page<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a screenshot showing the edit button visible to the Admin on the Admin Product List Page (The admin page)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236933660-20bd2a64-0fdc-437e-9270-3076cf047fab.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Edit button on shop page of admin<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a before and after screenshot of Editing a Product via the Admin Edit Product Page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236934578-21bff7c3-9fb3-4b2b-af4e-c97669bbe667.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Before editing a product<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236934687-48bd2aa5-4dae-4537-bf8c-f51f7d190055.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>After editing a product<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 5: </em> Briefly explain the code process/flow</td></tr>
<tr><td> <em>Response:</em> <div>-&nbsp; A user clicks the edit button on a product</div><div>- They are redirected<br>to the edit product page with the product id added as a param<br>on the url</div><div>- Using the product id, the product information is retrieved from<br>the database</div><div>- The form is prefilled with the product information</div><div>- The user edits<br>information and submits</div><div>- The updated information is updated to the table using an<br>UPDATE query.</div><br></td></tr>
<tr><td> <em>Sub-Task 6: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/dmp224/IT202-008/pull/46">https://github.com/dmp224/IT202-008/pull/46</a> </td></tr>
<tr><td> <em>Sub-Task 7: </em> Add a direct link to heroku prod for this file</td></tr>
<tr><td>Not provided</td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 5: </em> Product Details Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707834-bf5a5b13-ec36-4597-9741-aa830c195be2.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot showing the button (clickable item) that directs the user to the Product Details Page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236935157-fc0bfb58-6e0a-454e-a4c4-be4fd4ef91f3.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Button that directs user to product details page<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot showing the result of the Product Details Page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236937642-62376409-9c38-432a-b410-3679d58a4d05.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Product details page view<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Briefly explain the code process/flow</td></tr>
<tr><td> <em>Response:</em> <div>-&nbsp; A user clicks the product name which opens the product page</div><div>- They<br>are redirected to the product details page with the product id added as<br>a param on the url</div><div>- Using the product id, the product information is<br>retrieved from the database</div><div>- The information is then displayed on the page</div><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/dmp224/IT202-008/pull/46">https://github.com/dmp224/IT202-008/pull/46</a> </td></tr>
<tr><td> <em>Sub-Task 5: </em> Add a direct link to heroku prod for this file (can be any specific item)</td></tr>
<tr><td>Not provided</td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 6: </em> Add to Cart </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot of the success message of adding to cart</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236935542-6d8e0df5-63ca-418b-83cd-51a89c8f78f2.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Success message of adding product to cart<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot of the error message of adding to cart (i.e., when not logged in)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236935695-e59f8367-90bb-4914-bc6b-4dc5fe4be0d6.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Need to log in message shows when a non logged user tried to<br>add product to the cart<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a screenshot of the Cart table with data in it</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236935893-98a5abf7-1342-489c-b898-feff56c9bccb.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Cart table with data<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 4: </em> Tell how your cart works (1 cart per user; multiple carts per user)</td></tr>
<tr><td> <em>Response:</em> <div>- I am using 1 Cart per user policy, where all the products<br>in the cart for a user are considered as one cart.</div><div>- The user_id<br>and product_id should be unique together so that a user cannot have one<br>item multiple times in the cart.</div><div>- At one given point a product exist<br>only once in the user's cart.</div><div><br></div><br></td></tr>
<tr><td> <em>Sub-Task 5: </em> Explain the process of add to cart</td></tr>
<tr><td> <em>Response:</em> <div>- On the shop or product details page, a user can enter the<br>quantity they want to buy and click add to cart</div><div>- The information is<br>then added to the cart page.</div><div><br></div><br></td></tr>
<tr><td> <em>Sub-Task 6: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/dmp224/IT202-008/pull/46">https://github.com/dmp224/IT202-008/pull/46</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 7: </em> User will be able to see their Cart </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707834-bf5a5b13-ec36-4597-9741-aa830c195be2.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshot of the Cart View</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236936033-2ed66536-5360-4e50-afbb-382b4ac49a99.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>View of cart <br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explain how the cart is being shown from a code perspective along with the subtotal and total calculations</td></tr>
<tr><td> <em>Response:</em> <div>- On the cart page, the products are fetched based on the current<br>logged in user using the user_id</div><div>- We use a query with an inner<br>join between the Cart and Product table so as also to get the<br>product information</div><div>- To calculate the total, we loop through the product items, calculating<br>the subtotal by multiplying the unit_price and quantity,</div><div>&nbsp;which is then added to the<br>total.</div><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/dmp224/IT202-008/pull/46">https://github.com/dmp224/IT202-008/pull/46</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a direct link to heroku prod for this file</td></tr>
<tr><td>Not provided</td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 8: </em> User can update cart quantity </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Show a before and after screenshot of Cart Quantity update</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236936184-deba6761-ec6d-4395-b779-595f2c899178.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Before view of the cart<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236936300-6bc213ec-aac7-4af3-8031-af523c9d0125.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>After view of cart of quantity update<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Show a before and after screenshot of setting Cart Quantity to 0</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236936434-18518c32-8589-4b1d-a8a0-fd2b7c90ae35.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Before view of cart<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236936541-4c3f7acf-4ae5-43d9-8fbc-86580e9239b6.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>After view of cart after updating cart quantity to 0<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Show how a negative quantity is handled</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236936891-0b982835-1294-4b00-bdf2-74a9395cb329.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Handling negative quantity<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain the update process including how a value of 0 and negatives are handled</td></tr>
<tr><td> <em>Response:</em> <div>- On the cart page, each product row has update quantity form.</div><div>- The<br>quantity field is prefilled with the current quantity the user wants.</div><div>- Once the<br>user changes the quantity and submits, the requested quantity is first checked</div><div>- If<br>the quantity is 0 then the item is removed from the cart</div><div>- If<br>the quantity is greater than 0, then the new quantity is update in<br>the cart table</div><div>- The minimum you can enter on the quantity field is<br>0 therefore a negative value will be rejected on form validation</div><br></td></tr>
<tr><td> <em>Sub-Task 5: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/dmp224/IT202-008/pull/46">https://github.com/dmp224/IT202-008/pull/46</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 9: </em> Cart Item Removal </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a before and after screenshot of deleting a single item from the Cart</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236937041-33499931-4e57-4429-9cc6-8fa4cdce770c.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Before <br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236937153-d44e8abb-a876-456b-a1cb-c0bd40c323b7.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>After deleting a single item from the cart<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a before and after screenshot of clearing the cart</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236980328-9c6bbb24-9521-4b0f-91f7-551916e093fa.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Before<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236980338-af59b258-a1f7-418b-9140-9d6b9726d2ca.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>After<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Briefly explain how each delete process works</td></tr>
<tr><td> <em>Response:</em> <div>- Once you click remove button on a product, the item is removed<br>from the cart by matching</div><div>the product_id and the user_id of the current logged<br>in user. The page is then refreshed to get the&nbsp;</div><div>products in the cart.</div><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/dmp224/IT202-008/pull/46">https://github.com/dmp224/IT202-008/pull/46</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 10: </em> Misc </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707795-a9c94a71-7871-4572-bfae-ad636f8f8474.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots showing which issues are done/closed (project board) Incomplete Issues should not be closed (Milestone2 issues)</td></tr>
<tr><td><table><tr><td>Missing Image</td></tr>
<tr><td> <em>Caption:</em> (missing)</td></tr>
</table></td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-008-S23/it202-milestone-2-shop-project/grade/dmp224" target="_blank">Grading</a></td></tr></table>